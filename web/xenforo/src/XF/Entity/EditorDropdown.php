<?php

namespace XF\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;
use XF\Phrase;
use XF\Repository\EditorRepository;
use XF\Repository\IconRepository;

/**
 * COLUMNS
 * @property string $cmd
 * @property string $icon
 * @property array $buttons
 * @property int $display_order
 * @property bool $active
 *
 * GETTERS
 * @property-read Phrase $title
 *
 * RELATIONS
 * @property-read \XF\Entity\Phrase|null $MasterTitle
 */
class EditorDropdown extends Entity
{
	/**
	 * @return Phrase
	 */
	public function getTitle()
	{
		return \XF::phrase($this->getPhraseName());
	}

	public function getPhraseName()
	{
		return 'editor_dropdown.' . $this->cmd;
	}

	public function getMasterPhrase()
	{
		$phrase = $this->MasterTitle;
		if (!$phrase)
		{
			$phrase = $this->_em->create(\XF\Entity\Phrase::class);
			$phrase->title = $this->_getDeferredValue(function () { return $this->getPhraseName(); }, 'save');
			$phrase->language_id = 0;
			$phrase->addon_id = '';
		}

		return $phrase;
	}

	protected function _postSave()
	{
		if ($this->isChanged(['icon', 'active']))
		{
			$iconRepo = $this->repository(IconRepository::class);
			$iconRepo->enqueueUsageAnalyzer('editor');
		}

		$this->rebuildEditorConfigCache();
	}

	protected function _postDelete()
	{
		$iconRepo = $this->repository(IconRepository::class);
		$iconRepo->enqueueUsageAnalyzer('editor');

		$this->rebuildEditorConfigCache();
	}

	protected function rebuildEditorConfigCache()
	{
		\XF::runOnce('editorDropdownRebuild', function ()
		{
			$this->repository(EditorRepository::class)->rebuildEditorDropdownCache();
		});
	}

	public static function getStructure(Structure $structure)
	{
		$structure->table = 'xf_editor_dropdown';
		$structure->shortName = 'XF:EditorDropdown';
		$structure->primaryKey = 'cmd';
		$structure->columns = [
			'cmd' => ['type' => self::STR, 'maxLength' => 50, 'match' => self::MATCH_ALPHANUMERIC, 'required' => true],
			'icon' => ['type' => self::STR, 'maxLength' => 50, 'default' => ''],
			'buttons' => ['type' => self::JSON_ARRAY, 'default' => []],
			'display_order' => ['type' => self::UINT, 'default' => 0],
			'active' => ['type' => self::BOOL, 'default' => true],

		];
		$structure->getters = [
			'title' => true,
		];
		$structure->relations = [
			'MasterTitle' => [
				'entity' => 'XF:Phrase',
				'type' => self::TO_ONE,
				'conditions' => [
					['language_id', '=', 0],
					['title', '=', 'editor_dropdown.', '$cmd'],
				],
			],
		];

		return $structure;
	}
}

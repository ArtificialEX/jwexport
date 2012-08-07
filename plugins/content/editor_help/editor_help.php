<?php
/**
 * @package		Joomla.Site
 * @subpackage	plg_content_rating
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.utilities.date');

/**
 * An example custom profile plugin.
 *
 * @package		Joomla.Plugin
 * @subpackage	User.profile
 * @version		1.6
 */
class plgContentEditor_help extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       2.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	 * @param	string	$context	The context for the data
	 * @param	int		$data		The user id
	 * @param	object
	 *
	 * @return	boolean
	 * @since	2.5
	 */
	function onContentPrepareData($context, $data)
	{
		if (is_object($data))
		{
			$articleId = isset($data->id) ? $data->id : 0;
			if (!isset($data->rating) and $articleId > 0)
			{
				// Load the profile data from the database.
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->select('profile_key, profile_value');
				$query->from('#__user_profiles');
				$query->where('user_id = ' . $db->Quote($articleId));
				$query->where('profile_key LIKE ' . $db->Quote('rating.%'));
				$query->order('ordering');
				$db->setQuery($query);
				$results = $db->loadRowList();

				// Check for a database error.
				if ($db->getErrorNum())
				{
					$this->_subject->setError($db->getErrorMsg());
					return false;
				}

				// Merge the profile data.
				$data->rating = array();

				foreach ($results as $v)
				{
					$k = str_replace('rating.', '', $v[0]);
					$data->rating[$k] = json_decode($v[1], true);
					if ($data->rating[$k] === null)
					{
						$data->rating[$k] = $v[1];
					}
				}
			}
		}

		return true;
	}

	/**
	 * @param	JForm	$form	The form to be altered.
	 * @param	array	$data	The associated data for the form.
	 *
	 * @return	boolean
	 * @since	2.5
	 */
	function onContentPrepareForm($form, $data)
	{
		if (!($form instanceof JForm))
		{
			$this->_subject->setError('JERROR_NOT_A_FORM');
			return false;
		}

		// Add the extra fields to the form.
		// need a seperate directory for the installer not to consider the XML a package when "discovering"
		JForm::addFormPath(dirname(__FILE__) . '/rating');
		$form->loadFile('rating', false);

		return true;
	}

	/**
	 * Example after save content method
	 * Article is passed by reference, but after the save, so no changes will be saved.
	 * Method is called right after the content is saved
	 *
	 * @param	string		The context of the content passed to the plugin (added in 1.6)
	 * @param	object		A JTableContent object
	 * @param	bool		If the content is just about to be created
	 * @since	2.5
	 */
	public function onContentAfterSave($context, &$article, $isNew)
	{
		$articleId	= $article->id;
		if ($articleId && isset($article->rating) && (count($article->rating)))
		{
			try
			{
				$db = JFactory::getDbo();

				$query = $db->getQuery(true);
				$query->delete('#__user_profiles');
				$query->where('user_id = ' . $db->Quote($articleId));
				$query->where('profile_key LIKE ' . $db->Quote('rating.%'));
				$db->setQuery($query);
				if (!$db->query()) {
					throw new Exception($db->getErrorMsg());
				}

				$query->clear();
				$query->insert('#__user_profiles');
				$order	= 1;
				foreach ($article->rating as $k => $v)
				{
					$query->values($articleId.', '.$db->quote('rating.'.$k).', '.$db->quote(json_encode($v)).', '.$order++);
				}
				$db->setQuery($query);

				if (!$db->query()) {
					throw new Exception($db->getErrorMsg());
				}
			}
			catch (JException $e)
			{
				$this->_subject->setError($e->getMessage());
				return false;
			}
		}

		return true;
	}

	/**
	 * Finder after delete content method
	 * Article is passed by reference, but after the save, so no changes will be saved.
	 * Method is called right after the content is saved
	 *
	 * @param	string		The context of the content passed to the plugin (added in 1.6)
	 * @param	object		A JTableContent object
	 * @since   2.5
	 */
	public function onContentAfterDelete($context, $article)
	{
		
		$articleId	= $article->id;
		if ($articleId)
		{
			try
			{
				$db = JFactory::getDbo();

				$query = $db->getQuery(true);
				$query->delete();
				$query->from('#__user_profiles');
				$query->where('user_id = ' . $db->Quote($articleId));
				$query->where('profile_key LIKE ' . $db->Quote('rating.%'));
				$db->setQuery($query);

				if (!$db->query())
				{
					throw new Exception($db->getErrorMsg());
				}
			}
			catch (JException $e)
			{
				$this->_subject->setError($e->getMessage());
				return false;
			}
		}

		return true;
	}
		
}

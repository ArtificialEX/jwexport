<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/* The following line loads the MooTools JavaScript Library */
JHtml::_('behavior.framework', true);

/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();
$params		= $app->getParams();
?>
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

	<head>
		<!-- The following JDOC Head tag loads all the header and meta information from your site config and content. -->
		<jdoc:include type="head" />

		<!-- The following line loads the template CSS file located in the template folder. -->
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />

		<!-- The following line loads the template JavaScript file located in the template folder. It's blank by default. -->
		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/template.js"></script>
		
		<!--[if lte IE 6]>
			<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template_ie.css" rel="stylesheet" type="text/css" />
		<![endif]-->
		<!--[if IE 7]>
			<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template_ie.css" rel="stylesheet" type="text/css" />
		<![endif]-->
	
	</head>
	
	<body>
	
		<div class="contain-all">
		
			<!-- Sky -->
		
			<div id="sky">
			
				<div class="contain">
				
					<div id="sky-left" class="left"><a href="index.php"></a></div>
					
					<?php if($this->countModules('sky-right')) : ?>
						<div id="sky-right" class="right">
							<jdoc:include type="modules" name="sky-right" style="none" />
						</div>
					<?php endif; ?>
					
					<div class="clear"></div>
				
				</div>
			
			</div>
			
			<!-- Roof -->
			
			<div id="roof">
			
				<div class="contain">
				
					<div id="roof-mid"></div>
					
					<div class="clear"></div>
				
				</div>
			
			</div>
			
			<!-- Top -->
			
			<div id="top">
			
				<div class="contain">
				
					<?php if($this->countModules('top-left')) : ?>
						<div id="top-left" class="left">
							<jdoc:include type="modules" name="top-left" style="none" />
						</div>
					<?php endif; ?>
					
					<?php if($this->countModules('top-right')) : ?>
						<div id="top-right" class="right">
							<jdoc:include type="modules" name="top-right" style="none" />
						</div>
					<?php endif; ?>
					
					<div class="clear"></div>
				
				</div>
			
			</div>
			
			<!-- Main -->
			
			<div id="main">
			
				<div class="contain">
								
					<?php if($this->countModules('main-top')) : ?>
						<div id="main-top" class="full">
							<jdoc:include type="modules" name="main-top" style="none" />
						</div>
					<?php endif; ?>
				
					<?php if($this->countModules('main-left')) : ?>
						<div id="main-left" id="top" class="left">
							<jdoc:include type="modules" name="main-left" style="xhtml" />
						</div>
					<?php endif; ?>
					
					<?php if($this->countModules('main-right')) : ?>
						<div id="main-right" class="right">
							<jdoc:include type="modules" name="main-right" style="xhtml" />
						</div>
					<?php endif; ?>
					
					<?php if($this->countModules('main-title')) : ?>
						<div id="main-title" class="mid">
							<jdoc:include type="modules" name="main-title" style="none" />
							<h1><?php echo $params->get('page_heading'); ?></h1>
						</div>
					<?php endif; ?>
					
					<div id="main-mid" class="mid">
					
						<?php if($this->countModules('main-mid')) : ?>
							<jdoc:include type="modules" name="main-mid" style="none" />
						<?php endif; ?>
						
						<jdoc:include type="message" />
						<jdoc:include type="component" />
					
					</div>
					
					<?php if($this->countModules('main-bottom')) : ?>
						<div id="main-bottom" class="full">
							<jdoc:include type="modules" name="main-bottom" style="none" />
						</div>
					<?php endif; ?>
					
					<div class="clear"></div>
				
				</div>
			
			</div>
			
			<!-- Bottom -->
			
			<div id="bottom">
			
				<div class="contain">
				
					<?php if($this->countModules('bottom-left')) : ?>
						<div id="bottom-left" class="left">
							<jdoc:include type="modules" name="bottom-left" style="none" />
						</div>
					<?php endif; ?>
					
					<div id="bottom-right" class="right"></div>
					
					<div class="clear"></div>
				
				</div>
			
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		<!-- Foot -->
			
		<div id="foot">
		
			<div class="contain">
			
				<?php if($this->countModules('foot-left')) : ?>
					<div id="foot-left" class="left">
						<jdoc:include type="modules" name="foot-left" style="none" />
					</div>
				<?php endif; ?>
				
				<?php if($this->countModules('copyright')) : ?>
					<div id="copyright" class="left">
						<jdoc:include type="modules" name="copyright" style="none" />
					</div>
				<?php endif; ?>
				
				<?php if($this->countModules('foot-right')) : ?>
					<div id="foot-right" class="right">
						<jdoc:include type="modules" name="foot-right" style="none" />
					</div>
				<?php endif; ?>
				
				<div class="clear"></div>
				
				<!-- <?php echo date('Y'); ?> <?php echo htmlspecialchars($app->getCfg('sitename')); ?> -->
			
			</div>
		
		</div>
		
		<jdoc:include type="modules" name="debug" />
			
	</body>
	
</html>
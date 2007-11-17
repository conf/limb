<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2007 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @tag pager:LAST
 * @restrict_self_nesting
 * @parent_tag_class lmbMacroPagerTag
 * @package macro
 * @version $Id: last.tag.php 6386 2007-10-05 14:22:21Z serega $
 */
class lmbMacroPagerLastTag extends lmbMacroTag
{
  function generate($code)
  {
    $pager = $this->findParentByClass('lmbMacroPagerTag')->getPagerVar(); 
    
    $code->writePhp("if (!{$pager}->isLast()) {\n");
    $code->writePhp("\$href = {$pager}->getLastPageUri();\n");

    parent :: generate($code);

    $code->writePhp("}\n");
  }
}


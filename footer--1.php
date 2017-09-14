<?php

//����footer.php�Ĺ���
if (function_exists('jieqi_hooks_footer'))
{
	jieqi_hooks_footer();
}

// ���header.phpδ���룬�˴�����������ģ��INC����Ҫ�Ƿ�ҳ���ú���������
if (!empty($jieqiTset['jieqi_contents_template']) && !defined('JIEQI_INCLUDE_COMPILED_INC'))
{
	define('JIEQI_INCLUDE_COMPILED_INC', 1);

	if (!isset($jieqiTset['jieqi_contents_cacheid']))
	{
		$jieqiTset['jieqi_contents_cacheid'] = NULL;
	}

	if (!isset($jieqiTset['jieqi_contents_compileid']))
	{
		$jieqiTset['jieqi_contents_compileid'] = NULL;
	}

	$jieqiTpl->include_compiled_inc($jieqiTset['jieqi_contents_template'], $jieqiTset['jieqi_contents_compileid'], true);
}

//����ģ��������������ļ�
if (!empty($jieqiTset['jieqi_blocks_config']))
{
	if (!empty($jieqiTset['jieqi_blocks_module']))
	{
		jieqi_getconfigs($jieqiTset['jieqi_blocks_module'], $jieqiTset['jieqi_blocks_config'], 'jieqiBlocks');
	}
	else
	{
		jieqi_getconfigs(JIEQI_MODULE_NAME, $jieqiTset['jieqi_blocks_config'], 'jieqiBlocks');
	}
}

//���鴦��
if (!isset($jieqi_showlblock))
{
	$jieqi_showlblock = false;
}

if (!isset($jieqi_showcblock))
{
	$jieqi_showcblock = false;
}

if (!isset($jieqi_showrblock))
{
	$jieqi_showrblock = false;
}

if (!isset($jieqi_showtblock))
{
	$jieqi_showtblock = false;
}

if (!isset($jieqi_showbblock))
{
	$jieqi_showbblock = false;
}

//�������������ʾ��������ʾ���ֲ�ͼ
if (isset($jieqiBlocks) && is_array($jieqiBlocks))
{
	reset($jieqiBlocks);
	
	//foreach($jieqiBlocks as $key => $value)
	
	$i = 1;
	
	foreach($jieqiBlocks as $key )
	{
		//echo '<br><br><br>$key = ';
		
	//	var_dump($key);
		
		$bidindex = (empty($jieqiBlocks[$i]['bid']) ? 'bid' . $i : 'bid' . $key['bid']);
		
		//echo '<br><br><br>$bidindex = ';
		
		//var_dump($bidindex);
		
		$blockindex = $i;
		$blockvalue = jieqi_get_block($key);
		
	//	echo '<br><br><br>$blockvalue = ';
		
		//var_dump($blockvalue);
		
		if (!empty($blockvalue))
		{
			$jieqi_pageblocks[$blockindex] = $blockvalue;
			$jieqi_pageblocks[$bidindex] = $jieqi_pageblocks[$blockindex];
			$jieqi_blockside[$blockindex] = $jieqi_pageblocks[$blockindex];
			
		//	echo '<br><br><br>$jieqi_pageblocks = ';
		
		//	var_dump($jieqi_pageblocks);
		}
		
		$i++;
	}

	unset($blockindex);
	unset($bidindex);
	unset($blockvalue);
	unset($jieqiBlocks);
}

var_dump($jieqi_pageblocks);

$jieqi_showblock = $jieqi_showlblock | $jieqi_showcblock | $jieqi_showrblock | $jieqi_showtblock | $jieqi_showbblock;
$jieqiTpl->assign('jieqi_showblock', intval($jieqi_showblock));

if (isset($jieqi_pageblocks))
{
	$jieqiTpl->assign_by_ref('jieqi_pageblocks', $jieqi_pageblocks);
}




?>

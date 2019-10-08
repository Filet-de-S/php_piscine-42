#!/usr/bin/php
<?php
if ($argc != 2)
{
	print_r("Incorrect Parameters\n");
	exit;
}


$a = $argv[1];
$a = trim($a, " \t");
print_r("$a \n\n");
$i = 0;
$j = strlen($a);
for (; $i < $j; $i++)
{
	if (ctype_digit($a[$i]))
	{
		$d1 .= $a[$i];
		continue;
	}
	else
		break;
}
$del = NULL;
for (; $i < $j; $i++)
{
	echo (".{$a[$i]}.\n");
	if ($a[$i] != '%' || $a[$i] != '*' || $a[$i] != '+' || $a[$i] != '/' ||
	$a[$i] != '-' || $a[$i] != " ")
	{
		echo "Syntax Error\n";
		exit;
	}
	elseif ($a[$i] == " " && !$del)
		continue;
	elseif (!$del)
		$del = $a[$i];
}
print_r("AOASDK");
while ($a[$i] == " ")
		$i++;
for (; $i < $j; $i++)
{
	if (ctype_digit($a[$i]))
	{
		$d2 .= $a[$i];
		continue;
	}
	if (!ctype_digit($a[$i]))
	{
		echo "Syntax Error\n";
		exit;
	}	
}

print_r($a);


if ($del == '+')
	$fin = $d1 + $d2;
elseif ($del == '-')
	$fin = $d1 - $d2;
elseif ($del == "*")
	$fin = $d1 * $d2;
elseif ($del == '/')
	$fin = $d1 / $d2;
else
	$fin = $d1 % $d2;
echo $fin."\n";

?>
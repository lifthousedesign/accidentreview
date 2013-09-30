<?php echo doctype('html5') ?>
<head>
	<title><?php echo $title ?></title>
	<?php echo meta(array(
		array('name'=>'Content-type','content'=>'text/html; charset=utf-8','type'=>'equiv'),
		array('name'=>'X-UA-Compatible','content'=>'IE=edge,chrome=1','type'=>'equiv'),
		array('name'=>'viewport','content'=>'width=device-width'),
		array('name'=>'title','content'=>$meta['title']),
		array('name'=>'description','content'=>$meta['description']),
		array('name'=>'copyright','content'=>$meta['copyright']),
		array('name'=>'author','content'=>'Nick Niebaum (nickniebaum@gmail.com)'),
	)) ?>
	<?php echo css($css) ?>
</head>
<body>
<? if($_SERVER['HTTP_REFERER']){ ?>
<script>
setTimeout(function(){
	var html = '<a href="http://www.web2pdfconvert.com/convert" target="_blank">Save to PDF</a>'
		+ '<a href="javascript:window.print()">Print</a>';

	document.getElementById("button-container").innerHTML=html;
},1000);
</script>
<div id="button-container"></div>
<? } ?>
<?php echo $yield ?>
</body>
</html>
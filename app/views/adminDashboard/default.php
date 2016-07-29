<a href='#' class="button pull-right">Add Customer</a>
<h1>User List</h1>

<table class="table table-striped table-bordered table-hover" >
<tr>
	<th>ID</th>
	<th>Name</th>
	<th>Email</th>
	<th>Action</th>
</tr>
<tr>
<td>1</td>
<td>Muhammad Yaseen</td>
<td>muhammad.yaseen@coeus-solutions.de</td>
<td><a>Edit</a> / <a>Delete</a></td>
</tr>
<tr>
<td>2</td>
<td>Muhammad Yaseen</td>
<td>muhammad.yaseen@coeus-solutions.de</td>
<td><a>Edit</a> / <a>Delete</a></td>
</tr>
<tr>
<td>3</td>
<td>Muhammad Yaseen</td>
<td>muhammad.yaseen@coeus-solutions.de</td>
<td><a>Edit</a> / <a>Delete</a></td>
</tr>
<tr>
<td>4</td>
<td>Muhammad Yaseen</td>
<td>muhammad.yaseen@coeus-solutions.de</td>
<td><a>Edit</a> / <a>Delete</a></td>
</tr>
<tr>
<td>5</td>
<td>Muhammad Yaseen</td>
<td>muhammad.yaseen@coeus-solutions.de</td>
<td><a>Edit</a> / <a>Delete</a></td>
</tr>
<tr>
<td>6</td>
<td>Muhammad Yaseen</td>
<td>muhammad.yaseen@coeus-solutions.de</td>
<td><a>Edit</a> / <a>Delete</a></td>
</tr>
</table>

<?php
	use app\helpers\Helper;
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;
	echo Helper::pagination(50,$page);
 ?>
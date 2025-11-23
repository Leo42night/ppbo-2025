<?php
/** @var \LaundryApp\Model\Service[] $services */
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Laundry CRUD - OOP Demo</title>
<link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="container">
    <h1>Laundry Service - CRUD (OOP demo)</h1>
    <form id="form">
        <input type="hidden" id="id" />
        <div><label>Customer <input id="customer" required/></label></div>
        <div><label>Service <input id="service" required/></label></div>
        <div><label>Price <input id="price" type="number" step="0.01" required/></label></div>
        <div><label>Status 
            <select id="status">
                <option value="pending">pending</option>
                <option value="done">done</option>
            </select>
        </label></div>
        <div>
            <button id="save">Save</button>
            <button id="new" type="button">New</button>
        </div>
    </form>

    <h2>List</h2>
    <table id="tbl">
        <thead><tr><th>ID</th><th>Customer</th><th>Service</th><th>Price</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach($services as $s): ?>
            <tr data-id="<?=htmlspecialchars($s->id)?>">
                <td><?=htmlspecialchars($s->id)?></td>
                <td><?=htmlspecialchars($s->customer)?></td>
                <td><?=htmlspecialchars($s->service)?></td>
                <td><?=number_format($s->price,2)?></td>
                <td><?=htmlspecialchars($s->status)?></td>
                <td>
                    <button class="edit">Edit</button>
                    <button class="del">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <pre id="debug"></pre>
</div>
<script src="public/app.js"></script>
</body>
</html>

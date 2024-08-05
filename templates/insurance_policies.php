<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Policies</title>
    <link href="https://maxcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Insurance Policies</h1>
    <form method="post" action="">
        <fieldset>
            <legend>Select Attributes to Display:</legend>
            <?php foreach($availableColumns as $column): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="columns[]" value="<?= $column ?>" <?= in_array($column, $selectedColumns) ? 'checked' : '' ?>>
                    <label class="form-check-label">
                        <?= ucfirst(str_replace('_', ' ', $column)) ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>

    <table class="table table-bordered mt-4">
        <thead class="thead-light">
            <tr>
                <?php foreach($selectedColumns as $header) : ?>
                    <th><?php echo $header; ?></th>
                <?php endforeach;?>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1;$i < count($data); $i++) : ?>
                <tr>
                    <?php foreach ($data[$i] as $cell) : ?>
                        <td>
                            <?php echo $cell; ?>
                        </td>
                    <?php endforeach; ?>
                </tr> 
            <?php endfor; ?>
        </tbody>
    </table>
</div>
</body>

</html>
<?php
require 'db/database.php';
$database = new Database();
$conn = $database->dbConnection();
$query = "SELECT * FROM products";
$sql = $conn->prepare($query);
$row = $sql->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../style.css" />
    <title>Scandiweb</title>
</head>

<body>
    <div class="container m-5">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <p class="h2">Product List</p>
                <div>
                    <a href="../add-product" class="btn btn-success">Add</a>
                    <button disabled href="sasasasa" class="btn btn-danger" id="delete-product-btn">
                        MASS DELETE
                    </button>
                </div>
            </div>
            <hr />
        </div>
        <div class="col-lg-12">
            <div class="row px-3 d-flex justify-content-between">
                <?php while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-2 card pt-2 pb-2">
                        <div>
                            <input type="checkbox" class="delete-checkbox" value="<?php echo $row['id'] ?>" />
                        </div>
                        <div class="card-body p-0 text-center" width="auto">
                            <span><?php echo $row['sku'] ?></span>
                            <span><?php echo $row['name'] ?></span>
                            <span><?php echo $row['price'] ?> $</span>
                            <?php if ($row['productType'] == 'DVD') { ?>
                                <span> Size: <?php echo $row['size'] ?>MB</span>
                            <?php }
                            if ($row['productType'] == 'Book') { ?>
                                <span> Weight: <?php echo $row['weight'] ?>KG</span>
                            <?php }
                            if ($row['productType'] == 'Furniture') { ?>
                                <span> Dimenision: <?php echo $row['height'] . 'x' . $row['width'] . 'x' . $row['length'] ?></span>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <hr>
    </div>
    <script>
        var arr = [];
        $(document).ready(function() {
            $('input[class="delete-checkbox"]').on("change", function() {
                if ($(this).is(":checked")) {
                    if (!arr.includes($(this).val())) {
                        arr.push($(this).val());
                    }
                    console.log(arr);
                    $("#delete-product-btn").attr("disabled", false);
                } else if ($(this).is(":not(:checked)")) {
                    var vl = arr.indexOf($(this).val());
                    arr.splice(vl, 1);
                    if (arr.length == 0) {
                        $("#delete-product-btn").attr("disabled", true);
                    }
                    console.log(arr);
                }
            });
            $("#delete-product-btn").on("click", function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: "../db/delete.php",
                    type: "POST",
                    data: {
                        arr1: arr,
                    },
                    success: function(data) {
                        window.location.reload();
                        swal({
                            position: "top-end",
                            type: "success",
                            title: "Your work has been saved",
                            showConfirmButton: true,
                            timer: 15000
                        });
                    },
                    statusCode: {
                        404: function() {
                            console.log('404');
                        },
                        200: function() {
                            console.log('200');
                        },
                    },
                });
            });
        });
    </script>
</body>

</html>
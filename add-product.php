<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../style.css" />
    <title>Scandiweb</title>
</head>
<body>
    <div class="container m-5">
        <form id="#product_form" class="needs-validation" novalidate method="post" action="../db/create.php">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <p class="h2">Product Add</p>
                    <div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="/index" class="btn btn-danger" id="delete-product-btn">Cancel</a>
                    </div>
                </div>
                <hr />
            </div>
            <div class="col-lg-6">
                <div class="form-group row mb-3">
                    <label for="example-text-input" class="col-2 col-form-label">SKU</label>
                    <div class="col-10">
                        <input class="form-control" name="sku" type="text" placeholder="#sku" id="sku" required>
                    </div>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="example-text-input" class="col-2 col-form-label">Name</label>
                    <div class="col-10">
                        <input class="form-control" name="name" type="text" placeholder="#name" id="name" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="example-text-input" class="col-2 col-form-label">Price ($)</label>
                    <div class="col-10">
                        <input class="form-control" name="price" type="text" placeholder="#price" id="price" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="example-text-input" class="col-2 col-form-label">Type Switcher</label>
                    <div class="col-10">
                        <select class="form-control" name="productType" id="productType">
                            <option value="DVD">DVD</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Book">Book</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3" id="new-area">
                    <div class="alert alert-secondary text-center" role="alert">
                        DVD is selected
                    </div>
                    <label for="example-text-input" class="col-2 col-form-label">Size(MB)</label>
                    <div class="col-10"><input class="form-control" name="size" type="text" placeholder="#size" id="size"></div>
                </div>
            </div>
        </form>
    </div>
    <script>
        var arr = [];
        $(document).ready(function() {
            $('select[id="productType"]').on("change", function() {
                if ($(this).val() == 'DVD') {
                    let dvd = `
                    <div class="alert alert-secondary text-center" role="alert">
                        DVD is selected
                    </div>
                    <label for="example-text-input" class="col-2 col-form-label">Size(MB)</label>
                    <div class="col-10">
                    <input class="form-control" name="size" type="text" placeholder="#size" id="size">
                    </div>`;
                    $("#new-area").html(dvd);
                }
                if ($(this).val() == 'Book') {
                    let book = `
                    <div class="alert alert-secondary text-center" role="alert">
                    Book is selected
                    </div>
                    <label for="example-text-input" class="col-2 col-form-label">Weight(KG)</label>
                    <div class="col-10"><input class="form-control" name="weight" type="text" placeholder="#weight" id="weight">
                    </div>`;
                    $("#new-area").html(book);
                }
                if ($(this).val() == 'Furniture') {
                    let furniture = `
                <div class="alert alert-secondary text-center" role="alert">
                    Furniture is selected
                </div>
                <div class="form-group row mb-3">
                    <label for="example-text-input" class="col-2 col-form-label">Height(CM)</label>
                    <div class="col-10">
                        <input class="form-control" name="height" type="text" placeholder="#height" id="height">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="example-text-input" class="col-2 col-form-label">Width(CM)</label>
                    <div class="col-10">
                        <input class="form-control" name="width" type="text" placeholder="#width" id="width">
                    </div>
                </div>
                <div class="form-group row mb-3" id="new-area">
                    <label for="example-text-input" class="col-2 col-form-label">Length(CM)</label>
                    <div class="col-10">
                        <input class="form-control" name="length" type="text" placeholder="#length" id="length">
                    </div>
                </div>
                </div>`;
                    $("#new-area").html(furniture);
                }
            });
            $("#delete-product-btn").on("click", function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: "./db/delete.php",
                    type: "POST",
                    data: {
                        arr1: arr,
                    },
                    success: function(data) {
                        console.log(data);
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
<div class="container">
    <div class="row mt-5">
        <div class="col-md-4">
            <a href="index.php">
                <div class="step">
                    <i class="bi bi-grid-3x3-gap"></i>
                    <h4>Products</h4>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <div class="step">
                <i class="bi bi-x-diamond"></i>
                <h4>Details of a Product</h4>
            </div>
        </div>
        <div class="col-md-4">
            <a href="viewbasket.php">
                <div class="step active">
                    <i class="bi bi-cart3"></i>
                    <h4>Basket <span class="badge bg-secondary basket-count"><?=$BasketCount;?></span></h4>
                </div>
            </a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="line-black"></div>
        </div>
        <div class="col-md-3">
            <div class="line-white"></div>
        </div>
        <div class="col-md-3">
            <div class="line-black"></div>
        </div>
        <div class="col-md-3">
            <div class="line-white"></div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr class="table-dark">
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($products as $product){ ?>
                <tr>
                    <td><?=$product['info']->getName($product['info']->getProductId());?></td>
                    <td><input type="number" min="0" class="product-count form-control" value="<?=$product['count'];?>" data-id="<?=$product['info']->getProductId()?>"></td>
                    <td><span class="product-price"><?=$product['count'] * $product['info']->getPrice();?> <?=$product['info']->getCurrency();?></span></td>
                    <td><a class="btn btn-danger rounded-0 shadow remove-from-basket" data-id="<?=$product['info']->getProductId()?>"><i class="bi bi-trash"></i></a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="basket-status">
                <?php if (count($products) === 0) { ?>
                    <div class="isempty">
                            Currently, you have no product in the basket
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="basket-summary">
                <h5>Basket Summary <span class="recalc"></span></h5>
                <div>
                    <div class="pt-3">
                        <div class="container-fluid basket-products"></div>
                    </div>

                    <div class="p-4 pt-0">
                        <a class="btn btn-secondary rounded-0 shadow w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    recalc();
    $('.product-count').change(function (){
        let t = $(this)
        $.ajax({
            method: "POST",
            url: "Controller/BasketAjaxController.php",
            data: {
                updateQuantity: true,
                pid: $(this).data('id'),
                quantity: $(this).val()
            }
        }).done(function(e) {
            if(e.status){
                $('.basket-count').html(e.count);
                if(t.val() == 0){
                    t.closest('tr').remove()
                }
                t.parent().next().children('.product-price').html(e.price)
                recalc();
            }else{
                iziToast.show({
                    title: 'Error',
                    color: 'red',
                    message: e.message,
                    position: 'topRight'
                });
            }
        }).fail(function (e){
            iziToast.show({
                title: 'Error',
                color: 'red',
                message: e.responseText,
                position: 'topRight'
            });
        });
    })
    $('.remove-from-basket').click(function (){
        let t = $(this)
        $.ajax({
            method: "POST",
            url: "Controller/BasketAjaxController.php",
            data: {
                removeFromBasket: true,
                pid: $(this).data('id')
            }
        }).done(function(e) {
            if(e.status){
                $('.basket-count').html(e.count);
                t.closest('tr').remove()
                recalc()
            }else{
                iziToast.show({
                    title: 'Error',
                    color: 'red',
                    message: e.message,
                    position: 'topRight'
                });
            }
        }).fail(function (e){
            iziToast.show({
                title: 'Error',
                color: 'red',
                message: e.responseText,
                position: 'topRight'
            });
        });
    })

    function recalc(){
        $('.recalc').addClass('lds-hourglass')
        setTimeout(function (){
            $('.recalc').removeClass('lds-hourglass')
        },1000)

        let t = $(this)
        $.ajax({
            method: "POST",
            url: "Controller/BasketAjaxController.php",
            data: {
                getBasketSummary: true
            }
        }).done(function(e) {
            let output      = ""
            let total       = 0;
            let currency    = "";
            e.data.forEach(function (v,i){
               if(v.name === null){
                   v.name = "-"
               }
                output += '<div class="row mb-2">'+
                            '<div class="col-sm-4 text-start"><i class="bi bi-chevron-double-right"></i>'+v.name+'</div>'+
                            '<div class="col-sm-4 text-center">'+v.count+'</div>'+
                            '<div class="col-sm-4 text-end">'+v.count * v.price+' '+v.currency+'</div>'+
                        '</div>';
                total += v.count * v.price;
                currency = v.currency;
            })
            output += '<div class="row total-box pt-2">'+
                        '<div class="col-sm-4"></div>'+
                        '<div class="col-sm-4 text-center"><p class="fw-bold">Total</p></div>'+
                        '<div class="col-sm-4 text-end">'+total+' '+currency+'</div>'+
                    '</div>';
            $('.basket-products').html(output);
            if(e.data.length === 0){
                $('.basket-status').html('<div class="isempty">Currently, you have no product in the basket </div>');
            }
        }).fail(function (e){
            iziToast.show({
                title: 'Error',
                color: 'red',
                message: e.responseText,
                position: 'topRight'
            });
        });
    }
</script>

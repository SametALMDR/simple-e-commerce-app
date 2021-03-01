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
            <div class="step active">
                <i class="bi bi-x-diamond"></i>
                <h4>Details of a Product</h4>
            </div>
        </div>
        <div class="col-md-4">
            <a href="viewbasket.php">
                <div class="step">
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
    <div class="row mt-4 mb-5">
        <div class="offset-md-3 col-md-6 mb-4">
            <div class="product">
                <h4 class="product-name pt-2">
                    <?=$product->getName($product->getProductId());?></h4>
                <span class="badge bg-<?=$product->getProductStatus() === 1 ? "success" : "danger" ?> stock">
                    <?=$product->productStatus($product->getProductId());?>
                </span>
                <div class="product-info">
                    <div class="row">
                        <div class="col-6">
                            Category:
                        </div>
                        <div class="col-6">
                            <?=$product->getCategory($product->getProductId());?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            Sub Category:
                        </div>
                        <div class="col-6">
                            <?=$product->getSubCategory($product->getProductId());?>
                        </div>
                    </div>
                    <?php if(isset($product->cpu)) { ?>
                    <div class="row">
                        <div class="col-6">
                            CPU:
                        </div>
                        <div class="col-6">
                            <?=$product->cpu;?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if(isset($product->screenSize)) { ?>
                        <div class="row">
                            <div class="col-6">
                                Screen Size:
                            </div>
                            <div class="col-6">
                                <?=$product->screenSize;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(isset($product->os)) { ?>
                        <div class="row">
                            <div class="col-6">
                                Operating System:
                            </div>
                            <div class="col-6">
                                <?=$product->os;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(isset($product->ram)) { ?>
                        <div class="row">
                            <div class="col-6">
                                RAM:
                            </div>
                            <div class="col-6">
                                <?=$product->ram;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(isset($product->weight)) { ?>
                        <div class="row">
                            <div class="col-6">
                                Weight:
                            </div>
                            <div class="col-6">
                                <?=$product->weight;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(isset($product->foodType)) { ?>
                        <div class="row">
                            <div class="col-6">
                                Food Type:
                            </div>
                            <div class="col-6">
                                <?=$product->foodType;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(isset($product->packageType)) { ?>
                        <div class="row">
                            <div class="col-6">
                                Package Type:
                            </div>
                            <div class="col-6">
                                <?=$product->packageType;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(isset($product->race)) { ?>
                        <div class="row">
                            <div class="col-6">
                                Race:
                            </div>
                            <div class="col-6">
                                <?=$product->race;?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-2 mt-2">
                    <span class="price"><?=$product->getPrice();?></span> <span class="currency">/<?=$product->getCurrency();?></span>
                </div>
                <div class="row">
                    <div class="offset-sm-2 col-sm-8">
                        <input type="number" min="1" class="form-control w-100 product-count m-auto mb-3" value="1">
                        <button class="btn btn-sm bg-custom w-100 text-white add-to-basket" data-id="<?=$product->getProductId();?>" <?=$product->getProductStatus() !== 1?"disabled":""?>><i class="bi bi-cart-check"></i> Add to Basket</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.add-to-basket').click(function (){
        $.ajax({
            method: "POST",
            url: "Controller/BasketAjaxController.php",
            data: {
                addToBasket: true,
                pid: $(this).data('id'),
                count: $('.product-count').val()
            }
        }).done(function(e) {
            if(e.status){
                $('.basket-count').html(e.count);
                iziToast.show({
                    title: 'Success',
                    color: 'green',
                    message: e.message,
                    position: 'topRight'
                });
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
</script>

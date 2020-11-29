<?php
require APPROOT . '/views/inc/header.php'; ?>

<div class="row mb-3">

    <div class="col-md-6">
        <h1>Products</h1>
    </div>
    <div class="col-md-6">
        <a href="" class="btn btn-primary pull-right">
            <i class="fa fa-pencil">Add products</i>
        </a>
    </div>
</div>

<?php foreach ($data['products'] as $product) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $product->title; ?></h4>
        <div class="bg-light p-2 mb-3">
            Product Quaintity: <?php echo $product->product_qty; ?>
        </div>
        <p class="card-text"><?php echo $product->name ?></p>
        <a href="<?php APPROOT . 'posts/show/<?php echo $post->postId'; ?>" class="btn btn-dark">More</a>
    </div>

<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
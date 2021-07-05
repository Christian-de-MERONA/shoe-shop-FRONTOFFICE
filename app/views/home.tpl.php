<section>
  <div class="container-fluid">
    <div class="row mx-0">
      <?php for ($categoryIndex = 0; $categoryIndex < 2; $categoryIndex += 1) : ?>
        <div class="col-md-6">
          <!-- start first row -->
          <div class="card border-0 text-white text-center"><img src="<?= $categories[$categoryIndex]->getPicture() ?>" alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100 py-3">
                <h2 class="display-3 font-weight-bold mb-4">
                  <?= $categories[$categoryIndex]->getName() ?>
                </h2>
                <a href="<?= $router->generate('catalog-category', ['id' => $categories[$categoryIndex]->getId()]) ?>" class="btn btn-light">
                  <?= $categories[$categoryIndex]->getSubtitle() ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endfor ?>
    </div>

    <!-- end first row -->

    <div class="row mx-0">

      <?php for ($categoryIndex = 2; $categoryIndex < 5; $categoryIndex += 1) : ?>
        <div class="col-lg-4">
          <div class="card border-0 text-center <?= $categoryIndex === 3 ? "text-dark" : "text-white" ?>"><img src="<?= $categories[$categoryIndex]->getPicture() ?>" alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100">
                <h2 class="display-4 mb-4">
                  <?= $categories[$categoryIndex]->getName() ?>
                </h2>
                <a href="<?= $router->generate('catalog-category', ['id' => $categories[$categoryIndex]->getId()]) ?>" class="btn btn-link <?= $categoryIndex === 3 ? "text-dark" : "text-white" ?>">
                  <?= $categories[$categoryIndex]->getSubtitle() ?><i class="fa-arrow-right fa ml-2"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endfor ?>

    </div>
  </div>
</section>
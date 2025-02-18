<div class="product-card col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
    <div class="card p-2 position-relative">
        <div class="position-absolute fs-6 bg-danger text-white rounded" style="padding: 2px 8px;">15% Off</div>
        <button class="btn btn-white position-absolute my-w-fit-content border-0" style="right: 10px;position: absolute!important;">
            <i class="mdi mdi-heart-outline fs-5 text-secondary"></i>
        </button>
        <img src="{{ $product['image'] }}" class="product-image card-img-top rounded" alt="{{ $product['name'] }}">
        <div class="card-body px-1 pb-0 text-start">
            <!-- Rating -->
            <div class="text-warning rating">
                <i class="mdi mdi-star"></i>
                <i class="mdi mdi-star"></i>
                <i class="mdi mdi-star"></i>
                <i class="mdi mdi-star-outline"></i>
                <i class="mdi mdi-star-outline"></i>
            </div>
            <!-- First Title and Price (Initially Visible) -->
            <div class="d-flex justify-content-between align-items-center title-price-1">
                <div>
                    <h5 class="card-title mb-0">{{ $product['name'] }}</h5>
                    <p class="fw-bold text-warning mb-0 fs-4">${{ $product['price'] }}</p>
                </div>
                <!-- Plus Button -->
                <button class="btn btn-icon btn-warning text-white plus-btn">
                    <i class="mdi mdi-plus"></i>
                </button>
            </div>
            <!-- Second Title and Price (Initially Hidden) -->
            <div class="d-flex align-items-center justify-content-between title-price-2" style="display: none;">
                <h5 class="card-title mb-0 my-w-fit-content">{{ $product['name'] }}</h5>
                <p class="fw-bold text-warning mb-0 fs-4 my-w-fit-content">${{ $product['price'] }}</p>
            </div>
            <!-- Quantity Controls (Initially Hidden) -->
            <div class="row justify-content-between mx-1 mb-2 quantity-controls" style="display: none;">
                <div class="col-9">
                    <div class="row align-items-center">
                        <!-- Minus Button -->
                        <button class="btn btn-icon btn-warning text-white col-2 minus-btn">
                            <i class="mdi mdi-minus"></i>
                        </button>
                        <!-- Input Quantity -->
                        <div class="col-6">
                            <input type="number" class="form-control text-center quantity-input" value="1" min="1" max="10">
                        </div>
                        <!-- Plus Button -->
                        <button class="btn btn-icon btn-warning text-white col-2 plus-btn">
                            <i class="mdi mdi-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- Cart Button -->
                <button class="btn btn-icon btn-warning text-white col-3 cart-btn">
                    <i class="mdi mdi-cart-plus"></i>
                </button>
            </div>
            <!-- Go To Cart and Delete Buttons (Initially Hidden) -->
            <div class="row justify-content-between mx-1 mb-2 cart-actions" style="display: none;">
                <button class="btn btn-warning text-white col-9 go-to-cart-btn">
                    <i class="mdi mdi-cart-outline me-2 text-white"></i>
                    Go To Cart
                </button>
                <button class="btn btn-icon btn-danger text-white col-3 delete-btn">
                    <i class="mdi mdi-trash-can"></i>
                </button>
            </div>
        </div>
    </div>
</div>

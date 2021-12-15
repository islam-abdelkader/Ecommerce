<div class="primary-menu border-top">
    <div class="container">
        <nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
            <div class="offcanvas-header">
                <button class="btn-close float-end"></button>
                <h5 class="py-2 text-white">Navigation</h5>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item active"> <a class="nav-link" href="{{ route('site.home.index') }}">{{ __('content.home') }} </a>
                </li>
                <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                        data-bs-toggle="dropdown"> {{ __('content.categories') }}<i class='bx bx-chevron-down'></i></a>
                    <div class="dropdown-menu dropdown-large-menu">
                        <div class="row">
                            @foreach (\App\Models\Category::activeParent()->get() as $main_category )
                            <div class="col-md-4">
                                <h6 class="large-menu-title">{{ $main_category->name_en }}</h6>
                                <ul class="">
                                    @foreach(\App\Models\Category::getChildrenByParentId($main_category->id)
                                    as $sub_cat)
                                    <li><a href="#">{{ $sub_cat->name_en }}</a>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                            <!-- end col-3 -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- dropdown-large.// -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.shop.index') }}"> {{ __('content.shop') }} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.html"> {{ __('content.blog') }} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us.html"> {{ __('content.about') }} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.html"> {{ __('content.contact') }} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop-categories.html">{{ __('content.our stores') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('site.profile.index') }}">
                        {{ __('content.my account') }}
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

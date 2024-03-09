<style>
    header.main_menu {
        background-color: #333333;
        position:fixed;
    }

    #logo{
        position: relative;
        /* right:170px; */
        width: 130px;
    }

    #icon_menu {
        font-size: 17px;
    }    
</style>

<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{route('home')}}"> <img id="logo" src="{{asset('assets/img/logo-trang.png')}}" alt="logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="ti-menu-alt"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}" style="
                                font-size: 17px;padding-left:29px;color:#fff">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link"  id="navbarDropdown_1" href="{{route('shopcategory',['id'=> 0])}}" style="font-size: 17px;color:#fff">Clothes
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link "  id="navbarDropdown_3" 
                                    href="{{route('historyorder')}}" style="font-size: 17px;color:#fff">
                                    History
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('contact')}}" style="font-size: 17px;color:#fff">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="hearer_icon d-flex">
                        <div class="">
                            <a href="https://www.aptechvietnam.com.vn/"><i style="color:#FFF" id="icon_menu" class="fa-solid fa-earth-asia"></i></a>
                            
                            <a href="{{route('shopingcart')}}"><i class="fa-solid fa-cart-shopping" style="margin-top: 10px; margin-left: 24px; color:#FFF"></i>
                            </a>
                        </div>
                        @if(Auth::check() && Auth()->user()->level ==2)
                        <a href="{{route('logout')}}"><i class="fa-solid fa-arrow-right-from-bracket" style="margin-top: 10px; color:#FFF"></i>
                        </a>
                            <a style="padding: 8px 0 0 20px" href="{{route('user.profile.profile')}}"><strong style="color:#FFF;">{{auth()->user()->name}}</strong></a>
                            @else 
                            <a href="{{route('login')}}" style="padding: 5px 0 0 20px; color: #FFF"> Login
                            </a>
                            @endif</i>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
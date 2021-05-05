<?php
    if(!isset($_SESSION["user"])) 
    { 
        $user="";
    } else if(isset($_SESSION['user'])){
        $user = $_SESSION["user"]; 
    }
?>
<!DOCTYPE html>
<html lang=en>

<head>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../Css/menu.css">
    <link rel="stylesheet" type="text/css" href="../Css/responsive.css">
</head>

<body>
    <header>
        <nav class="header-navbar hide-on-mobile">
            <div class="header-with-logo container">
                <div class="header-logo-contact">
                    <div class="header-logo-item">
                        <i class="fas fa-map-marker-alt"></i>
                        Phường Hòa Quý, Quận Ngũ Hành Sơn, TP. Đà Nẵng
                    </div>
                    <div class="header-logo-item">
                        <i class="fas fa-phone-alt"></i>
                        0123456789
                    </div>
                </div>
                <div class="header-logo-wrap">
                    <a href="../View/index.php">
                    <img src="../image/logohome.png" alt="">
                </a>
                </div>
                <div class="header-logo-social">
                    <div class="header-logo-children">
                        <a href="" class="header-logo-link">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                        <a href="" class="header-logo-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="" class="header-logo-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="" class="header-logo-link">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                        <a href="" class="header-logo-link">
                            <i class="fab fa-dribbble"></i>
                        </a>
                        <?php 
                            if ($user=="") 
                            {
                                echo '
                                    <a href="../View/login.php" class="header-logo-link">
                                        ĐĂNG NHẬP
                                    </a>
                                    <a href="../View/login.php" class="header-logo-link">
                                        ĐĂNG KÝ
                                    </a>
                                ';
                            } else {
                                $conn = mysqli_connect("localhost","root","","mytour");
                                $sql = "SELECT * FROM account WHERE username ='".$user."'";
                                $result = mysqli_query($conn,$sql);
                                $acc = mysqli_fetch_assoc($result);
                                $_SESSION['iduser']=$acc['id'];
                                if ($acc['image']=='') {
                                    $ava = "image/avat.jpg";
                                } else {
                                    $ava = $acc['image'];
                                }
                                echo '
                                    <a href="../Model/logout.php" class="header-logo-link">
                                        ĐĂNG XUẤT
                                    </a>
                                    <a href="../View/account.php" class="header-logo-link">
                                        <img style="width: 35px;height: 35px;border-radius: 50%;margin-right:7px;border:2px solid white;" src="../'.$ava.'">
                                        '.$user.'
                                    </a>
                                ';
                            }
                            
                        ?>
                    </div>
                </div>
            </div>
            <div class="header-navbar-item-wrap">
                <ul class="header-navbar-list">
                    <li class="header-navbar-item">
                        <a href="../View/index.php" class="header-navbar__link">
                            TRANG CHỦ
                        </a>
                    </li>
                    <li class="header-navbar-item dropdown">
                        <a href="javascript:avoid(0)" class="header-navbar__link dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                            KHÁCH SẠN
                        </a>
                        <?php 
                            $conn = mysqli_connect("localhost","root","","mytour");
                            $query = "SELECT *  FROM category";
                            $kq = mysqli_query($conn,$query);
                            echo '<div class="dropdown-menu">
                            <a href=../View/category.php?id=0 class="dropdown-item">Tất cả</a>';
                            while($dong = mysqli_fetch_assoc($kq)){
                                if($dong[   "parent_id"]==0)
                                    echo '<a class="dropdown-item" href=../View/category.php?id='.$dong['id'].'>'.$dong['namecate'].' </a>';
                                    echo "<ul>";
                                    $kq2= mysqli_query($conn,$query);
                                    while ($dong1 =mysqli_fetch_assoc($kq2)) {
                                        if ($dong1["parent_id"]==$dong["id"]) {
                                             echo '<li><a class="dropdown-item" href=../View/category.php?id='.$dong1['id'].'>'.$dong1['namecate'].' </a></li>';
                                        }
                                    }
                                    echo "</ul>";
                            }
                            echo '</div>';
                        ?>
                    </li>
                    <li class="header-navbar-item">
                        <a href="../View/blog.php" class="header-navbar__link">
                            CẨM NANG                           
                        </a>
                    </li>
                    <li class="header-navbar-item">
                        <a href="../View/contact.php" class="header-navbar__link">
                            LIÊN HỆ
                        </a>
                    </li>
                    <li class="header-navbar-item">
                        <a href="../View/about-us.php" class="header-navbar__link">
                            GIỚI THIỆU
                        </a>
                    </li>
                    <li class="header-navbar-item">
                        <?php 
                            if ($user=="") 
                            {
                                echo '<a href="" class="header-navbar__link">
                                        ĐƠN HÀNG CỦA TÔI
                                      </a>';
                            } else {
                                echo '<a href="../View/vieworder.php" class="header-navbar__link">
                                        ĐƠN HÀNG CỦA TÔI
                                      </a>';
                            }
                        ?>
                    </li>
                    <li class="header-navbar-item">
                        <?php 
                            if ($user=="") 
                            {
                                echo '<a href="../View/login.php" class="header-navbar__link">
                                        TÀI KHOẢN
                                      </a>';
                            } else {
                                echo '<a href="../View/account.php" class="header-navbar__link">
                                        TÀI KHOẢN
                                      </a>';
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="mobile-navbar">
            <div class="mobile-header">
                <div class="mobile-left">
                    <div class="mobile-bar">
                        <label for="bar-check" class="header__bar-wrap">
                            <i class="fas fa-bars"></i>
                        </label>
                        <input type="checkbox" id="bar-check" hidden class="sidebar-check">
                        <label for="bar-check" class="sidebar-overlay"></label>
                        <nav class="sidebar-mobile-tablet ">
                            <ul class="sidebar-list">
                                <li class="sidebar-item">
                                    <span href="#" class="sidebar-link">MYTOUR</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="../View/index.php" class="sidebar-link">TRANG CHỦ</a>
                                    <i class="fas fa-chevron-right right-icon"></i>
                                </li>
                                <li class="sidebar-item format">
                                    <a href="#" class="sidebar-link">KHÁCH SẠN</a>
                                    <i class="fas fa-chevron-right right-icon"></i>
                                </li>
                                <li class="sidebar-item format">
                                    <a href="#" class="sidebar-link">CẨM NANG</a>
                                    <i class="fas fa-chevron-right right-icon"></i>
                                </li>
                                <li class="sidebar-item format">
                                    <a href="../View/contact.php" class="sidebar-link">LIÊN HỆ</a>
                                    <i class="fas fa-chevron-right right-icon"></i>
                                </li>
                                <li class="sidebar-item format">
                                    <a href="../View/about-us.php" class="sidebar-link">GIỚI THIỆU</a>
                                    <i class="fas fa-chevron-right right-icon"></i>
                                </li>
                                <li class="sidebar-item format">
                                    <a href="#" class="sidebar-link">ĐƠN HÀNG CỦA TÔI</a>
                                    <i class="fas fa-chevron-right right-icon"></i>
                                </li>
                                <li class="sidebar-item format">
                                    <a href="#" class="sidebar-link">TÀI KHOẢN</a>
                                    <i class="fas fa-chevron-right right-icon"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-logo">
                        <img src="../image/logo.png" alt="" class="mobile-logo-img">
                    </div>
                </div>
                <div class="header__search">
                    <div class="header__icon-wrap">
                        <label for="check-search" class="search-icon-wrap">
                            <i class="fas fa-search header__icon header__icon-search"></i>
                        </label>
                        <input type="checkbox" id="check-search" hidden class="check-to-open-search">
                        <label for="check-search" class="overlay-search"></label>
                        <div class="mobile-search">
                            <form>
                                <div class="form-group">
                                    <div class="mobile-search-title">Tìm kiếm nhanh</div>
                                </div>
                              <div class="form-group">
                                <label>Ngày đến:</label>
                                <input type="date" name="checkin" id="check_in_date_5fe2a8777a803" 
                                class="hb_input_date_check hasDatepicker form-control" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" style="font-size: 16px;">
                              <div class="form-group mt-3" >
                                <label>Ngày đi: </label>
                                <input type="date" name="checkout" id="check_out_date_5fe2a8777a803" 
                                class="hb_input_date_check hasDatepicker form-control" value="<?php echo date('Y-m-d',strtotime('+1 day', strtotime(date('Y/m/d')))); ?>" style="font-size: 16px;">
                              </div>
                              <div class="form-group mt-3" >
                                <label>Khu vực: </label>
                                <select name="" id="" style="font-size: 16px; height: 30px;" class="form-control">
                                    <option value="1">Quận Hải Châu</option>
                                    <option value="1">Quận Hải Châu</option>
                                    <option value="1">Quận Hải Châu</option>
                                </select>
                              </div>
                              <div class="form-group mt-3" >
                                <label>Số lượng: </label>
                                <input type="number" name="" id="" style="font-size: 16px;" placeholder="1 phòng" class="form-control">
                              </div>
                              <div class="form-group text-right">
                                  <button type="submit" class="btn btn-primary" style="font-size: 16px;">Tìm kiếm</button>
                              </div>
                            </form>    
                        </div>
                    </div>
                    <div class="mobile-user">
                        <i class="fas fa-user header__icon header__icon-user "></i>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <script>
    $(document).ready(function(){       
        var urlPath = window.location.pathname;
        var pathName = urlPath.slice(urlPath.indexOf('View')+5);
        var urlNavTransparent = ['index.php', 'detailhotel.php', 'detailroom.php'];
        if(urlNavTransparent.indexOf(pathName) != -1) {
            $(".header-navbar").addClass('header-navbar-homepage');
        } else {
            $(".header-navbar").removeClass('header-navbar-homepage');
        }
        var scroll_pos = 0;
        $(document).scroll(function() {
            scroll_pos = $(this).scrollTop();
            if(scroll_pos > 10) {
                $(".header-navbar").addClass('header-navbar--scroll');
            } else {
                $(".header-navbar").removeClass('header-navbar--scroll');
            }
        });

        $('.header__bar-wrap').on('click', function() {
            $('#check-search').prop('checked', false);
        })
    });
    </script>
</body>

</html>

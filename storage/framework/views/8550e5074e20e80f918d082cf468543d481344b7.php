<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" ng-app="myApp">
    <head>
        <?php ($siteInfo = settings()); ?>
        <!-- required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- title -->
        <title><?php echo e((!empty($siteInfo->site_name) ? $siteInfo->site_name : '')); ?></title>
        <!-- favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset(!empty($siteInfo->favicon) ? $siteInfo->favicon : '')); ?>">

        <!-- ionicons css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <!-- toastr css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <!-- selectpicker css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <!-- datepicker css -->
        <link rel="stylesheet" href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css">
        <!-- perfect scrollbar css -->
        <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/vendors/scrollbar/perfect-scrollbar.css">
        <!-- include style -->
        <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/style/master.css">


        <!-- jQuery js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Anguler Js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>var app = angular.module('myApp', []);</script>
        <?php echo $__env->yieldPushContent('header-style'); ?>
        <?php echo $__env->yieldPushContent('header-script'); ?>
    </head>
    
    <body>
        
        <section class="wrapper" data-menu="<?php echo e((!empty($asideMenu) ? $asideMenu : '')); ?>" data-submenu="<?php echo e((!empty($asideSubmenu) ? $asideSubmenu : '')); ?>">
            <!-- panel aside start -->
            <aside class="panel_aside">
                <div class="brand">
                    <span class="brand_icon"><i class="icon ion-md-home"></i></span>
                    <h3><?php echo e(strFilter(Auth::user()->name)); ?></h3>
                    <a href="javascript:void(0)" id="panelClose_btn">
                        <i class="icon ion-ios-close io-36"></i>
                    </a>
                    <a href="javascript:void(0)" id="panelOpen_btn">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <!-- aside nav start -->
                <?php ($privilege = Auth::user()->privilege); ?>
                <?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
                <ul class="aside_nav">
                    <?php if(($privilege == 'super') ||  ($privilege == 'super') || ((!empty($accessList->dashboard->mainmenu) && $accessList->dashboard->mainmenu == "dashboard"))): ?>
                    <!-- dashboard -->
                    <li id="dashboard">
                        <a href="<?php echo e(route('admin.dashboard')); ?>">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="menu_title">ড্যাশবোর্ড</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    

                    <?php if(($privilege == 'super') ||  ($privilege == 'super') || (!empty($accessList->member->mainmenu) && $accessList->member->mainmenu == "member")): ?>
                    <!-- Product -->
                    <li id="member" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-user-shield"></i>
                            <span class="menu_title">সদস্য</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            <?php if(($privilege == 'super') ||   (!empty($accessList->member->submenu->new_member) && $accessList->member->submenu->new_member == "new_member")): ?>
                            <li class="addMember"><a href="<?php echo e(route('admin.member.create')); ?>">নতুন সদস্য</a></li>
                            <?php endif; ?>
                            
                            <?php if(($privilege == 'super') ||  ( !empty($accessList->member->submenu->all_member) && $accessList->member->submenu->all_member == "all_member")): ?>
                            <li class="allMember"><a href="<?php echo e(route('admin.member')); ?>">সকল সদস্য</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <?php if(($privilege == 'super') ||  ($privilege == 'super') || (!empty($accessList->bazar_member->mainmenu) && $accessList->bazar_member->mainmenu == "bazar_member")): ?>
                    <!-- Bazar Member -->
                    <li id="bazar_member" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-user-shield"></i>
                            <span class="menu_title">বাজারের সদস্য</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            <?php if(($privilege == 'super') ||   (!empty($accessList->bazar_member->submenu->new_member) && $accessList->bazar_member->submenu->new_member == "new_member")): ?>
                            <li class="addMember"><a href="<?php echo e(route('admin.bazar_member.create')); ?>">নতুন সদস্য</a></li>
                            <?php endif; ?>
                            
                            <?php if(($privilege == 'super') ||  ( !empty($accessList->bazar_member->submenu->all_member) && $accessList->bazar_member->submenu->all_member == "all_member")): ?>
                            <li class="allMember"><a href="<?php echo e(route('admin.bazar_member')); ?>">সকল সদস্য</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    
                    <?php if(($privilege == 'super') ||  (!empty($accessList->tax_collection->mainmenu) && $accessList->tax_collection->mainmenu == "tax_collection")): ?>
                    <!-- Tax Collection -->
                    <li id="tax_collection" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-money-bill-wave"></i>
                            <span class="menu_title">কর-সংগ্রহ</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->tax_collection->submenu->add_tax) && $accessList->tax_collection->submenu->add_tax == "add_tax")): ?>
                            <li class="addTaxCollection"><a href="<?php echo e(route('admin.tax-collection.create')); ?>">নতুন কর-সংগ্রহ করুন</a></li>
                            <?php endif; ?>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->tax_collection->submenu->all_tax) && $accessList->tax_collection->submenu->all_tax == "all_tax")): ?>
                            <li class="allTaxCollection"><a href="<?php echo e(route('admin.tax-collection')); ?>">সকল কর দেখুন</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>


                    <?php if(($privilege == 'super') ||  (!empty($accessList->affidavit->mainmenu) && $accessList->affidavit->mainmenu == "affidavit")): ?>
                    <!-- Affidavit -->
                    <li id="affidavit" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span class="menu_title">প্রত্যয়ন পত্র</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->affidavit->submenu->citizenship_certificate) && $accessList->affidavit->submenu->citizenship_certificate == "citizenship_certificate")): ?>
                            <li class="citizenshipCertificate"><a href="<?php echo e(route('admin.affidavit.create')); ?>"> নাগরিকত্ব সনদ পত্র </a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(($privilege == 'super') ||  (!empty($accessList->notice->mainmenu) && $accessList->notice->mainmenu == "notice")): ?>
                    <!-- Notice -->
                    <li id="notice" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span class="menu_title">ট্যাক্স নোটিশ</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->notice->submenu->add_notice) && $accessList->notice->submenu->add_notice == "add_notice")): ?>
                            <li class="addNotice"><a href="<?php echo e(route('admin.notice.create')); ?>">নতুন নোটিশ</a></li>
                            <?php endif; ?>
                            
                            <?php if(($privilege == 'super') ||  ( !empty($accessList->notice->submenu->all_notice) && $accessList->notice->submenu->all_notice == "all_notice")): ?>
                            <li class="allNotice"><a href="<?php echo e(route('admin.notice')); ?>">সকল নোটিশ</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    
                    <?php if(($privilege == 'super') ||  (!empty($accessList->report->mainmenu) && $accessList->report->mainmenu == "report")): ?>
                    <!-- Report -->
                    <li id="report" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-flag"></i>
                            <span class="menu_title">রিপোর্ট</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->report->submenu->tax_report) && $accessList->report->submenu->tax_report == "tax_report")): ?>
                            <li class="taxReport"><a href="<?php echo e(route('admin.reports.tax')); ?>">সকল ট্যাক্স রিপোর্ট</a></li>
                            <?php endif; ?>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->report->submenu->union_report) && $accessList->report->submenu->union_report == "union_report")): ?>
                            <li class="unionReport"><a href="<?php echo e(route('admin.reports.union_report')); ?>">ইউনিয়ন রিপোর্ট</a></li>
                            <?php endif; ?>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->report->submenu->member_wise_tax_report) && $accessList->report->submenu->member_wise_tax_report == "member_wise_tax_report")): ?>
                            <li class="memberReport"><a href="<?php echo e(route('admin.reports.member')); ?>">সদস্য ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
                            <?php endif; ?>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->report->submenu->ward_wise_tax_report) && $accessList->report->submenu->ward_wise_tax_report == "ward_wise_tax_report")): ?>
                            <li class="wardReport"><a href="<?php echo e(route('admin.reports.ward')); ?>">ওয়ার্ড ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
                            <?php endif; ?>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->report->submenu->daily_tax_report) && $accessList->report->submenu->daily_tax_report == "daily_tax_report")): ?>
                            <li class="collectionReport"><a href="<?php echo e(route('admin.reports.collection')); ?>">দৈনিক ট্যাক্স সংগ্রহ রিপোর্ট</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    
                    <?php if(($privilege == 'super') ||  (!empty($accessList->trade_license->mainmenu) && $accessList->trade_license->mainmenu == "trade_license")): ?>
                    <!-- Mobile Sms -->
                    <li id="trade_license" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-comment-dots"></i>
                            <span class="menu_title">ট্রেড লাইসেন্স</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            <?php if(($privilege == 'super') || (!empty($accessList->trade_license->submenu->add_trade) && $accessList->trade_license->submenu->add_trade=="add_trade")): ?>
                            <li class="add_trade"><a href="<?php echo e(route('admin.trade_license.create')); ?>"> নতুন ট্রেড লাইসেন্স </a></li>
                            <?php endif; ?>
                            <?php if(($privilege == 'super') || (!empty($accessList->trade_license->submenu->all_trade) && $accessList->trade_license->submenu->all_trade=="all_trade")): ?>
                            <li class="all_trade"><a href="<?php echo e(route('admin.trade_license')); ?>"> সকল ট্রেড লাইসেন্স </a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <?php if(($privilege == 'super') ||  (!empty($accessList->mobile_sms->mainmenu) && $accessList->mobile_sms->mainmenu == "mobile_sms")): ?>
                    <!-- Mobile Sms -->
                    <li id="sms" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-comment-dots"></i>
                            <span class="menu_title">এসএমএস</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            <?php if(($privilege == 'super') || (!empty($accessList->mobile_sms->submenu->custom_sms) && $accessList->mobile_sms->submenu->custom_sms=="custom_sms")): ?>
                            <li class="customSms"><a href="<?php echo e(route('admin.sms.custom_sms')); ?>">কাস্টম এসএমএস</a></li>
                            <?php endif; ?>
                            <?php if(($privilege == 'super') || (!empty($accessList->mobile_sms->submenu->send_sms) && $accessList->mobile_sms->submenu->send_sms=="send_sms")): ?>
                            <li class="sendSms"><a href="<?php echo e(route('admin.sms.send_sms')); ?>">সেন্ড এসএমএস</a></li>
                            <?php endif; ?>
                            <?php if(($privilege == 'super') || (!empty($accessList->mobile_sms->submenu->sms_report) && $accessList->mobile_sms->submenu->sms_report=="sms_report")): ?>
                            <li class="smsReport"><a href="<?php echo e(route('admin.sms')); ?>">এসএমএস রিপোর্ট</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <?php if(($privilege == 'super') ||  (!empty($accessList->chairman->mainmenu) && $accessList->chairman->mainmenu == "chairman")): ?>
                    <!-- Chairman -->
                    <li id="chairman" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-people-arrows"></i>
                            <span class="menu_title"> চেয়ারম্যান ও সচিব </span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            <?php if(($privilege == 'super') ||  (!empty($accessList->chairman->submenu->add_chairman) && $accessList->chairman->submenu->add_chairman == "add_chairman")): ?>
                            <li class="addChairman"><a href="<?php echo e(route('admin.chairman.create')); ?>">নতুন চেয়ারম্যান</a></li>
                            <?php endif; ?>
                            
                            <?php if(($privilege == 'super') ||  ( !empty($accessList->chairman->submenu->all_chairman) && $accessList->chairman->submenu->all_chairman == "all_chairman")): ?>
                            <li class="allChairman"><a href="<?php echo e(route('admin.chairman')); ?>">সব দেখুন</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <!-- Not User Only Admin & Super -->
                    <?php if($privilege != 'user'): ?>
                        <?php if( ($privilege == 'super') || (!empty($accessList->user->mainmenu) && $accessList->user->mainmenu == "user")): ?>
                        <li id="user" class="dropdown">
                            <a href="javascript:void(0)">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="menu_title">ইউজার</span>
                                <span class="menu_arrow">
                                    <i class="icon ion-ios-arrow-forward right"></i>
                                    <i class="icon ion-ios-arrow-down down"></i>
                                </span>
                            </a>
                            <ul>
                                <?php if( ($privilege == 'super') || (!empty($accessList->user->submenu->add_user) && $accessList->user->submenu->add_user=="add_user")): ?>
                                <li class="add_user"><a href="<?php echo e(route('admin.user.create')); ?>">নতুন ইউজার</a></li>
                                <?php endif; ?>
                                <?php if( ($privilege == 'super') || (!empty($accessList->user->submenu->all_user) && $accessList->user->submenu->all_user=="all_user")): ?>
                                <li class="all_user"><a href="<?php echo e(route('admin.user')); ?>">সকল ইউজার</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if( ($privilege == 'super') || (!empty($accessList->privilege->mainmenu) && $accessList->privilege->mainmenu == "privilege")): ?>
                        <!-- privilege -->
                        <li id="privilege">
                            <a href="<?php echo e(route('admin.privilege')); ?>">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="menu_title">প্রিভিলেজ</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if( ($privilege == 'super') || (!empty($accessList->settings->mainmenu) && $accessList->settings->mainmenu == "settings")): ?>
                        <!-- Settings -->
                        <li id="settings">
                            <a href="<?php echo e(route('admin.settings')); ?>">
                                <i class="fas fa-cogs"></i>
                                <span class="menu_title">সেটিংস</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </aside>
            <!-- panel aside end -->


            <!-- body section start -->
            <div class="main_body">
                <!-- main nav start -->
                <nav class="main_nav">
                    <ul class="function_menu">
                        <li class="user_dropdown">
                            <a href="javascript:void(0)" id="aside-toggle">
                                <i class="icon ion-ios-menu io-23"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="user_menu">
                        <!-- message -->
                        <li class="user_dropdown">
                            <a href="javascript:void(0)" class="menu-button">
                                <i class="icon ion-ios-mail io-21"></i>
                            </a>
                            <ul class="sub_menu">
                                <li class="head">
                                    <a href="javascript:void(0)">
                                        <h6>You have 2 Message</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span>Awesome aminmate.css</span>
                                        <small>10 minit ago</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span>Awesome aminmate.css</span>
                                        <small>10 minit ago</small>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- profile -->
                        <li class="user_dropdown">
                            <a href="javascript:void(0)" class="menu-button">
                                <?php if(!empty(Auth::user()->avatar)): ?>
                                    <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" alt="">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('backend')); ?>/images/user/02.png" alt="">
                                <?php endif; ?>
                            </a>
                            <ul class="sub_menu">
                                <li class="head">
                                    <a href="">
                                        <h6><?php echo e(strFilter(Auth::user()->name)); ?></h6>
                                        <small><?php echo e(strFilter(Auth::user()->privilege)); ?></small>
                                    </a>
                                </li>
                                <li><a href="<?php echo e(route('admin.user.show', strEncode(Auth::user()->id))); ?>">প্রোফাইল</a></li>
                                <li>
                                    <a href="<?php echo e(route('admin.logout')); ?>"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">লগআউট</a>

                                    <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- main nav end -->

                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- body section end -->


            <!-- footer start -->
            <!--<div class="developer">-->
            <!--    <p>Developed By : <a href="https://freelanceitlab.com/" target="_blank">Freelance It Lab</a></p>-->
            <!--</div>-->
            <div class="wrapper_background"></div>
        </section>


        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
        <!-- selectpicker js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <!-- toastr js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- ckeditor4 js -->
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        <!-- datepicker js -->
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
        <!-- perfect scrollbar js -->
        <script src="<?php echo e(asset('backend')); ?>/vendors/scrollbar/perfect-scrollbar.min.js"></script>

        <!-- include js -->
        <script src="<?php echo e(asset('backend')); ?>/js/app.js"></script>
        <script src="<?php echo e(asset('backend')); ?>/js/ngScript.js"></script>

        <?php echo $__env->make('components.toastr', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldPushContent('footer-style'); ?>
        <?php echo $__env->yieldPushContent('footer-script'); ?>
    </body>
</html>

<?php /**PATH /home/kajodrsv/amaruptax.com/resources/views/layouts/backend.blade.php ENDPATH**/ ?>
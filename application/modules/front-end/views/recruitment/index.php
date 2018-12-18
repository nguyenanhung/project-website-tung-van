<div class="page-header">
    <div class="container">
        <h1 class="title">Tuyển dụng</h1>
    </div>
    <div class="breadcrumb-box">
        <div class="container">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Tuyển dụng
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div id="testimonial-section" class="padding pt-xs-60">
    <div class="container">
        <div class="row">
            <p class="title"> Các vị trí đang tuyển</p>
        </div>
        <div class="row">
            <div class="col-md-2 col-sm-3 col-sx-12" id="img">
                <img src="<?php echo base_url('assets/images/') . 'hot.png' ?>" class="blink" alt="abc">
            </div>
            <div class="col-md-6 col-sm-5" id="list_job">
                <ul >
                    <?php foreach ($list_job as $item) {
                        if ($item->created_at >= config_item('cf_date')) {
                            $type = "new";
                        } else {
                            $type = $item->type == 2 ? 'hot' : '';
                        }
                        ?>
                        <li "><a class="<?php echo $type ?>"
                               href="<?php echo base_url('tuyen-dung/') . $item->slugs ?>"><?php echo $item->title ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="sidebar-widget">
                    <h3>Việc làm HOT</h3><hr>
                    <ul class="widget-post pt-15">
                        <?php foreach ($list_job as $item) {
                            if ($item->type==2){ ?>
                                <li>
                                    <a href="<?php echo site_url('tuyen-dung/' . $item->slugs) ?>"><?php echo $item->title; ?></a>
                                </li>
                        <?php  }
                        } ?>
                    </ul>
                </div>
                <div class="sidebar-widget">
                    <h3>Tìm kiếm</h3><hr>
                    <form action="" method="get" >
                        <div class="row container">
                            <input type="text" placeholder="nhập key word" id="keyword" name="keyword" class="form-control"style="width: 80%" >
                            <button type="submit" data-url="<?php echo base_url('front-end/recruitment/search')?>" class="btn btn-default" name="search" value="search" style="width: 20%"><i class="fa fa-search"></i></button>
                        </div>
                        <span id="result"></span>
                        <div class="row container">
                            <ul class="tags">
                                <?php foreach ($tags as $item) {
                                    ?>
                                    <li><a href="<?php echo base_url('tuyen-dung/tags/').$item->tags?>"><?php echo $item->tags?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8" id="result_filter"></div>
        </div>
    </div>
</div>
<style>
    .title{
        font-size: 30px;
        font-style: italic;
        color: red;
    }
    .hot {
        background: url(<?php echo base_url('assets/images/').'hot.gif' ?>) right top no-repeat;
        padding-right: 24px;
    }

    .new {
        background: url(<?php echo base_url('assets/images/').'new.gif' ?>) right top no-repeat;
        background-size: 35px 28px;
        padding-right: 35px;
        height: 70px;
        margin: 0 0 15px;
        overflow: hidden;
        width: 100%;
    }
    .tags{
        padding-left: 0;
    }
    .tags li {
        position: relative;
        padding-left: 15px;
        padding: 5px 10px 5px 10px;
    }
    .tags li:before {
        content: "";
        background-image: url(<?php echo base_url('assets/images/').'icon_tag_career.png' ?>);
        position: absolute;
        left: 0;
        width: 15px;
        height: 15px;
        display: block;
        background-repeat: no-repeat;
        background-size: contain;
        top: 50%;
        transform: translateY(-50%);
    }
    .tags li{
        display: block;
        float: left;
    }
    .tags li a{
        font-size: 18px;
        padding: 5px;
    }
    .sidebar-widget ul li a {
        display: inline-block;
        font-size: 14px;
        color: #323232;
        cursor: pointer;
    }
    #list_job li{
        list-style-type: none;
        padding: 5px 0px;
    }
</style>
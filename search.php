<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
</head>
<script src="jq.js"></script>
<body>

<style type="text/css" media="screen">
    .search-panel .item {
        display: inline-block;
        padding: 5px;
        margin: 5px;
        background-color: #EEE;
        cursor: pointer;
    }

    .search-panel .search-active {
        background-color: green;
    }

</style>

<div class="search-panel">
    <div>
        <div class="item" data-search-field="name" data-search-value="名字1">名字1</div>
        <div class="item" data-search-field="name" data-search-value="名字2">名字2</div>
        <div class="item search-active" data-search-field="name" data-search-value="">默认无name</div>
    </div>
    <div>
        <div class="item" data-search-field="sex" data-search-value="1">男</div>
        <div class="item" data-search-field="sex" data-search-value="0">女</div>
        <div class="item search-active" data-search-field="sex" data-search-value="">默认无sex</div>
    </div>
    <div>
        <div class="item" data-search-field="age" data-search-value="15">15</div>
        <div class="item" data-search-field="age" data-search-value="16">16</div>
        <div class="item" data-search-field="age" data-search-value="17">17</div>
        <div class="item" data-search-field="age" data-search-value="18">18</div>
        <div class="item search-active" data-search-field="age" data-search-value="">默认无age</div>
    </div>
</div>
<script>


    var searchUrl = "<?php echo './search.php'; ?>";
    var searchQuery = <?php echo json_encode($_GET,JSON_FORCE_OBJECT); ?>;

    //初始化页面样式还原成当前搜索条件的布局
    init();
    function init() {
        for (field in searchQuery) {
            $("[data-search-field='" + field + "']").removeClass("search-active");
            $("[data-search-field='" + field + "'][data-search-value='" + searchQuery[field] + "']").addClass("search-active");
        }
    }

    function buildQuery(condition) {
        searchQuery = $.extend(searchQuery, condition);

        for (field in condition) {
            //删除置空数据
            if (condition[field] === "") {
                delete searchQuery[field];
            }
        }
        //console.info(searchQuery)
        //console.info(searchUrl + '?' + $.param(searchQuery))
    }

    function goSearch() {
        //把searchQuery对象转成符合url参数形式后跳转
        window.location.href = searchUrl + '?' + $.param(searchQuery);
    }

    $("[data-search-field]").on("click", function () {
        var field = $(this).data('search-field');
        var value = $(this).data('search-value');
        var condition = {}
        condition[field] = value;
        buildQuery(condition);
        goSearch();
    })

</script>
</body>
</html>
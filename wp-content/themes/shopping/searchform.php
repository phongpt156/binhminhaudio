<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
    <input class="text-search" type="text" value="Nhập từ khóa..."
        name="s" id="s"  onblur="if (this.value == '')  {this.value = 'Nhập từ khóa...';}"
        onfocus="if (this.value == 'Nhập từ khóa...') {this.value = '';}" />
    <input type="submit" id='buttom-search' class='buttom-search gradient' value="Tìm kiếm" />
    <!-- <button>Tìm kiếm</button> -->
</form>
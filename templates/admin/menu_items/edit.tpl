{if isset($get_single_rows)}
    {foreach $get_single_rows as  $value}
        <div class="row">
            <form action="" method="POST">
                <div class="col-md-4">
                    <div class="tabbable tab-content-bordered">
                        <div class="tab-content">
                            <div class="tab-pane active" id="">		
                                <div class="panel-body">
                                    {if isset($get_query_builder)}
                                    <div class="form-group">
                                        <label>Kateqoriya Section</label>
                                        <select class="form-control" name="menu_id">
                                            {foreach $get_query_builder as $menu}
                                            <option value="{$menu.id}" {if $value.menu_id eq $menu.id}selected{/if}>{$menu.name}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                    {/if} 
                                    {if isset($get_parent_menu)} 
                                    <div class="form-group">
                                        <label>Ana Kateqoriya</label>
                                        <select class="form-control" name="parent">
                                            <option value="0" {if $value.parent eq 0}selected{/if}>-- SEÇ --</option>
                                            {foreach $get_parent_menu as $items}
                                            <option value="{$items.id}" {if $value.parent eq $items.id}selected{/if}>{$items.name}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                    {/if} 
                                    <div class="form-group">
                                        <label>Sıra nömrəsi</label>
                                        <input type="number" class="form-control"  name="order"  value="{$value.order}" />
                                    </div>
                                    <div class="form-group ">
                                        <label>Status</label>
                                        <select name="status" id="status" class="bootstrap-select" data-style="btn-default btn-xs" data-width="100%">
                                            <option {if $value.status eq 0}selected{/if} value="0">Disable</option>
                                            <option {if $value.status eq 1}selected{/if} value="1">Enable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tabbable tab-content-bordered">
                        <ul class="nav nav-tabs nav-tabs-highlight nav-justified" id="language">
                            {if isset($language_list) && is_object($language_list)}
                                {foreach $language_list as $language}
                                    <li><a href="#{$language->slug}" data-toggle="tab">{$language->name} <img src="{base_url('templates/admin/assets/images/flags/')}{$language->code}.png" alt="{$language->name}" class="pull-right"></a></li>
                                {/foreach}
                            {/if}
                        </ul> 

                        <div class="tab-content">
                            {if isset($language_list) && is_object($language_list)}
                                {foreach $language_list as $key=>$language}
                                    <div class="tab-pane active" id="{$language->slug}">									
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label>Kateqoriya adı</label>
                                                <input type="hidden" name="lang_id[]" value="{$language->id}">
                                                <input type="text" class="form-control" value="{$get_single_lang_rows[$language->id][0]['name']}" name="name[]"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" class="form-control" value="{$get_single_lang_rows[$language->id][0]['slug']}" name="slug[]"/>
                                            </div>
                                            <div class="form-group">
                                                <label></label>
                                                <button type="submit" class="btn btn-success">Yadda saxla</button>
                                            </div>
                                        </div>					
                                    </div>
                                {/foreach}
                            {/if}
                        </div> 
                    </div>
                </div>
            </form>
        </div>
    {/foreach}
{/if}
<style type="text/css">
.cf:after {
     visibility: hidden;
     display: block;
     font-size: 0;
     content: " ";
     clear: both;
     height: 0;
}
 * html .cf {
     zoom: 1;
}
 *:first-child+html .cf {
     zoom: 1;
}
 .dd {
     position: relative;
     display: block;
     margin: 0;
     padding: 0;
     max-width: 600px;
     list-style: none;
     font-size: 13px;
     line-height: 20px;
}
 .dd-list {
     display: block;
     position: relative;
     margin: 0;
     padding: 0;
     list-style: none;
}
 .dd-list .dd-list {
     padding-left: 30px;
}
 .dd-collapsed .dd-list {
     display: none;
}
 .dd-item, .dd-empty, .dd-placeholder {
     display: block;
     position: relative;
     margin: 0;
     padding: 0;
     min-height: 20px;
     font-size: 13px;
     line-height: 20px;
}
 .dd-handle {
     padding: 6px 12px;
     margin-bottom: 5px;
     background-color: #fcfcfc;
     border: 1px solid #ddd;
     border-radius: 2px;
     cursor: pointer;
     color: #777;
     font-weight: bold;
     font-size: 13px;
}
 .dd-handle:hover {
     background: #fff;
}
 .dd-item > button {
     display: block;
     position: relative;
     cursor: pointer;
     float: left;
     width: 25px;
     height: 20px;
     margin: 5px 0;
     padding: 0;
     text-indent: 100%;
     white-space: nowrap;
     overflow: hidden;
     border: 0;
     background: transparent;
     font-size: 12px;
     line-height: 1;
     text-align: center;
     font-weight: bold;
}
 .dd-item > button:before {
     content: '+';
     display: block;
     position: absolute;
     width: 100%;
     text-align: center;
     text-indent: 0;
}
 .dd-item > button[data-action="collapse"]:before {
     content: '-';
}
 .dd-placeholder, .dd-empty {
     margin: 5px 0;
     padding: 0;
     min-height: 30px;
     background: #f2fbff;
     border: 1px dashed #b6bcbf;
     box-sizing: border-box;
     -moz-box-sizing: border-box;
}
 .dd-empty {
     border: 1px dashed #bbb;
     min-height: 100px;
     background-color: #e5e5e5;
     background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
     background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
     background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
     background-size: 60px 60px;
     background-position: 0 0, 30px 30px;
}
 .dd-dragel {
     position: absolute;
     pointer-events: none;
     z-index: 9999;
}
 .dd-dragel > .dd-item .dd-handle {
     margin-top: 0;
}
 .dd-dragel .dd-handle {
     -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
     box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}
/** * Nestable Extras */
 .nestable-lists {
     display: block;
     clear: both;
     width: 100%;
     border: 0;
}
 #nestable-menu {
     padding: 0;
     margin: 20px 0;
}
 #nestable-output, #nestable2-output {
     width: 100%;
     height: 7em;
     font-size: 0.75em;
     line-height: 1.333333em;
     font-family: Consolas, monospace;
     padding: 5px;
     box-sizing: border-box;
     -moz-box-sizing: border-box;
}
 #nestable2 .dd-handle {
     color: #fff;
     border: 1px solid #999;
     background: #bbb;
     background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
     background: -moz-linear-gradient(top, #bbb 0%, #999 100%);
     background: linear-gradient(top, #bbb 0%, #999 100%);
}
 #nestable2 .dd-handle:hover {
     background: #bbb;
}
 #nestable2 .dd-item > button:before {
     color: #fff;
}
 @media only screen and (min-width: 700px) {
     .dd {
         float: left;
         width: 70%;
    }
     .dd + .dd {
         margin-left: 2%;
    }
}
 .dd-hover > .dd-handle {
     background: #2ea8e5 !important;
}
/** * Nestable Draggable Handles */
 .dd3-content {
     display: block;
     height: 30px;
     margin: 5px 0;
     padding: 5px 10px 5px 40px;
     color: #333;
     text-decoration: none;
     font-weight: bold;
     border: 1px solid #ccc;
     background: #fafafa;
     background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
     background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
     background: linear-gradient(top, #fafafa 0%, #eee 100%);
     -webkit-border-radius: 3px;
     border-radius: 3px;
     box-sizing: border-box;
     -moz-box-sizing: border-box;
}
 .dd3-content:hover {
     color: #2ea8e5;
     background: #fff;
}
 .dd-dragel > .dd3-item > .dd3-content {
     margin: 0;
}
 .dd3-item > button {
     margin-left: 30px;
}
 .dd3-handle {
     position: absolute;
     margin: 0;
     left: 0;
     top: 0;
     cursor: pointer;
     width: 30px;
     text-indent: 100%;
     white-space: nowrap;
     overflow: hidden;
     border: 1px solid #aaa;
     background: #ddd;
     background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
     background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
     background: linear-gradient(top, #ddd 0%, #bbb 100%);
     border-top-right-radius: 0;
     border-bottom-right-radius: 0;
}
 .dd3-handle:before {
     content: '≡';
     display: block;
     position: absolute;
     left: 0;
     top: 3px;
     width: 100%;
     text-align: center;
     text-indent: 0;
     color: #fff;
     font-size: 20px;
     font-weight: normal;
}
 .dd3-handle:hover {
     background: #ddd;
}
/** * Socialite */
 .socialite {
     display: block;
     float: left;
     height: 35px;
}
</style>
{literal}
<script>
$(document).ready(function() {
    var updateOutput = function(e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    $('#nestable').nestable({group: 1}).on('change', updateOutput);
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    updateOutput($('#nestable2').data('output', $('#nestable2-output')));
    $('#nestable-menu').on('click', function(e) {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });
});
</script>
{/literal}
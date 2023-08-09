<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* extension/purpletree_multivendor/catalog/view/template/multivendor/beforeheader.twig */
class __TwigTemplate_70b2a48dc8ba4dca7a1462e0601061f7e45353363d821f4c340d4782e4b8b2f4 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        if (($context["hyper_status"] ?? null)) {
            // line 2
            if (($context["sellerareas"] ?? null)) {
                // line 3
                echo "<div class=\"text-center pts-hyperlocal-heading\"> ";
                echo ($context["hp_heading"] ?? null);
                echo "&nbsp <a class=\"launch-modal\">";
                echo ($context["seller_area_namea"] ?? null);
                echo "</a></div>
<div id =\"overlay\"class=\"wait ptsc-wait\">
<div id=\"wait\" class=\"ptsc-sellerarea-loder\"><img class=\"ptsc-sellerarea-loderimgcol\"src='";
                // line 5
                echo ($context["hyperlocal_loder"] ?? null);
                echo "' alt=\"&nbsp Loading..\" width=\"64\" height=\"64\" /><br></div>
</div>
<div class=\"modal fade\" id=\"sellerarea_modal\" data-bs-backdrop=\"static\" data-bs-keyboard=\"false\" tabindex=\"-1\" aria-labelledby=\"staticBackdropLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <p class=\"text-primary ptsc-sellerarea-hyphead\">";
                // line 11
                echo ($context["hp_heading"] ?? null);
                echo "</p>
\t\t\t\t";
                // line 12
                if ((($context["seller_area"] ?? null) != "")) {
                    // line 13
                    echo "                <button type=\"button\" class=\"close pts-hyperlocal-close ptsc-sellerarea-martr\" data-bs-dismiss=\"modal\">&times;</button>
\t\t\t\t";
                } else {
                    // line 15
                    echo "\t\t\t\t\t";
                    if ( !($context["area_status_check"] ?? null)) {
                        // line 16
                        echo "\t\t\t\t\t\t <button type=\"button\" class=\"btn-close pts-hyperlocal-close ptsc-sellerarea-martr\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
\t\t\t\t\t";
                    }
                    // line 18
                    echo "\t\t\t\t";
                }
                // line 19
                echo "            </div>
";
                // line 20
                if ((($context["hyperlocal_type"] ?? null) == "0")) {
                    // line 21
                    echo "            <div class=\"modal-body\"> 
                <form>
                    <div class=\"pts-form-group\">
                      <select name=\"pts_customer_area\" class=\"form-select pts_customer_area ptsc-quick-deliverb\" id=\"select_sellerarea\">
\t\t\t\t\t ";
                    // line 25
                    if ( !($context["check_seller_area"] ?? null)) {
                        // line 26
                        echo "\t\t\t\t\t  ";
                        if ((($context["check_seller_area"] ?? null) != "0")) {
                            // line 27
                            echo "\t\t\t\t\t  <option value=\"\" class=\"pts-form-control\" selected=\"selected\">
                           <span class=\"location\">";
                            // line 28
                            echo ($context["text_hyper_selects"] ?? null);
                            echo "</span>
                       </option>
\t\t\t\t\t   ";
                        }
                        // line 31
                        echo "\t\t\t\t\t   ";
                    }
                    // line 32
                    echo "                       ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["sellerareas"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["sellerarea"]) {
                        // line 33
                        echo "\t\t\t\t\t   ";
                        if ((twig_get_attribute($this->env, $this->source, $context["sellerarea"], "area_id", [], "any", false, false, false, 33) == ($context["check_seller_area"] ?? null))) {
                            // line 34
                            echo "\t\t\t\t\t   ";
                            if ((($context["check_seller_area"] ?? null) != "")) {
                                // line 35
                                echo "\t\t\t\t\t    <option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["sellerarea"], "area_id", [], "any", false, false, false, 35);
                                echo "\" class=\"pts-form-control\" selected=\"selected\">
                           <span class=\"location\">";
                                // line 36
                                echo twig_get_attribute($this->env, $this->source, $context["sellerarea"], "area_name", [], "any", false, false, false, 36);
                                echo "</span>
                       </option>
\t\t\t\t\t   ";
                            } else {
                                // line 38
                                echo " 
\t\t\t\t\t   <option value=\"";
                                // line 39
                                echo twig_get_attribute($this->env, $this->source, $context["sellerarea"], "area_id", [], "any", false, false, false, 39);
                                echo "\" class=\"pts-form-control\">
                           <span class=\"location\">";
                                // line 40
                                echo twig_get_attribute($this->env, $this->source, $context["sellerarea"], "area_name", [], "any", false, false, false, 40);
                                echo "</span>
                       </option>
\t\t\t\t\t   ";
                            }
                            // line 43
                            echo "\t\t\t\t\t   ";
                        } else {
                            echo " 
                       <option value=\"";
                            // line 44
                            echo twig_get_attribute($this->env, $this->source, $context["sellerarea"], "area_id", [], "any", false, false, false, 44);
                            echo "\" class=\"pts-form-control\">
                           <span class=\"location\">";
                            // line 45
                            echo twig_get_attribute($this->env, $this->source, $context["sellerarea"], "area_name", [], "any", false, false, false, 45);
                            echo "</span>
                       </option>
\t\t\t\t\t   ";
                        }
                        // line 47
                        echo " 
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sellerarea'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 48
                    echo "  
              </select>     
                    </div>    
                </form>
            </div>
\t\t\t ";
                }
                // line 53
                echo " 
";
                // line 54
                if ((($context["hyperlocal_type"] ?? null) == "1")) {
                    // line 55
                    echo "        <div class=\"modal-body\"> 
               
\t\t\t\t <div class=\"row\">
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"text\" name=\"search_area\" value=\"";
                    // line 59
                    echo ($context["search_area"] ?? null);
                    echo "\" placeholder=\"";
                    echo ($context["text_search_area_placeholder"] ?? null);
                    echo "\" id=\"input-name\" class=\"form-control pts-text-box-width\" list=\"input-search-by-name\" />
\t\t\t\t\t<dataList id=\"input-search-by-name\"></dataList>
\t\t\t\t\t<input type=\"hidden\" name=\"search_area_id\" value=\"\"  id=\"search_area_id\" />
\t\t\t\t\t<input type=\"hidden\" name=\"search_area_id_temp\" value=\"\"  id=\"search_area_id\" />
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-2\">
\t\t\t\t\t<button id=\"btn_search_area\" class=\"control-label pts-search-area-btn\" >";
                    // line 65
                    echo ($context["text_seller_area_ok"] ?? null);
                    echo "</button>
\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t
\t\t\t\t<div class=\"row\">
\t\t\t\t    <div id=\"search_alert\" class=\"alert text-danger\">
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t
\t\t\t
        </div>
 ";
                }
                // line 76
                echo " 
 ";
                // line 77
                if ((($context["hyperlocal_type"] ?? null) == "2")) {
                    // line 78
                    echo "        <div class=\"modal-body\"> 
               
\t\t\t\t <div class=\"row\">
\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"text\" name=\"search_text\" value=\"";
                    // line 82
                    echo ($context["search_text"] ?? null);
                    echo "\" placeholder=\"";
                    echo ($context["search_text"] ?? null);
                    echo "\" id=\"search_text\" class=\"form-control pts-text-box-width\" />
\t\t\t\t\t<input type=\"hidden\" name=\"search_area_id\" value=\"\"  id=\"search_area_id\" />
\t\t\t\t\t<input type=\"hidden\" name=\"search_area_id_temp\" value=\"\"  id=\"search_area_id\" />
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-2\">
\t\t\t\t\t<button id=\"btn_search_area\" class=\"control-label pts-search-area-btn\" >";
                    // line 87
                    echo ($context["text_seller_area_ok"] ?? null);
                    echo "</button>
\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t
\t\t\t\t<div class=\"row\">
\t\t\t\t    <div id=\"search_alert\" class=\"alert text-danger\">
\t\t\t\t\t</div>
\t\t\t\t</div>
        </div>
 ";
                }
                // line 96
                echo " 
\t\t\t
        </div>
    </div>
</div>

<script>
\$(document).ready(function(){
\t\$('#search_alert').css('display','none');
\t\$('.launch-modal').click(function(){
\t\tvar seller_area_popup = new bootstrap.Modal(document.getElementById('sellerarea_modal'))
\t\tseller_area_popup.show();
\t}); 
});
\$( \".pts_customer_area\" ).change(function() {
     var str = \"\";
    \$( \"#select_sellerarea option:selected\" ).each(function() {
\t  str =  \$( this ).val();
    });
\tif(str== ''){
\t     str = \$('#pts_customer_area').val();
\t\t}
\tvar hyper_type = 1;
\thyperlocalAjax(str,hyper_type);
});
\$(window).on(\"load\", function() {
 var check_seller_area = '";
                // line 122
                echo ($context["check_seller_area"] ?? null);
                echo "';
\tif(check_seller_area == ''){
      \$('.launch-modal').click();
\t}
});
";
                // line 127
                if ((($context["check_seller_area"] ?? null) == "")) {
                    // line 128
                    echo "\$(document).ready(function(){\t 
\t\$('.pts-hyperlocal-close').click(function(){
\t  var hyper_type = 2;\t
\t  var str = 0;
\t  hyperlocalAjax(str,hyper_type);
\t});
});
";
                }
                // line 135
                echo " 
function hyperlocalAjax(str,hyper_type){
\t\$.ajax({
\t\t\t\turl: 'index.php?route=extension/purpletree_multivendor/multivendor/sellerregister|sethyperlocalvalue&seller_area=' + str,
\t\t\t\tdataType: 'json',\t\t\t\t
\t\t\t\tbeforeSend:function(){
\t\t\t\tif( hyper_type == 1){
\t\t\t\t    \$(\"#sellerarea_modal\").modal('hide');
\t\t\t\t    \$(\"#wait\").css(\"display\", \"block\");
\t\t\t\t    \$(\"#overlay\").css(\"display\", \"block\");
\t\t\t\t   }
\t\t\t\t\t},\t\t\t\t
\t\t\t\tsuccess: function(json) {\t\t\t\t    
\t\t\t\t\tif(json.status == 'success') {
\t\t\t\t\t  if( hyper_type == 1){
\t\t\t\t\t\tlocation.reload();
\t\t\t\t\t  }
\t\t\t\t\t}
\t\t\t\t},
\t\t\t\terror: function(json) {\t
\t\t\t\t\t window.location.replace(\"";
                // line 155
                echo ($context["base_url"] ?? null);
                echo "\");
\t\t\t\t}
\t\t\t\t/* complete:function(){
\t\t\t\t\t\$(\"#wait\").css(\"display\", \"none\");
\t\t\t\t\t} */
\t\t\t})
}

  \$('input[name=\\'search_area\\']').autocomplete({
    'source': function(request, response) {
      \$.ajax({
        url: 'index.php?route=extension/purpletree_multivendor/multivendor/common/header|seachArea &search_area='+encodeURIComponent(request),
        dataType: 'json',
\t\t type: 'get',
        success: function(json) {
\t\t\t/*if(json.length == 1){
\t\t\t  \$('input[name=\\'search_area_id_temp\\']').val('');
\t\t\t}*/
          response(\$.map(json, function(item) {
            return {
              label: item['area_name'],
              value: item['area_id']
            }
          }));
        }
      });
    },
    'select': function(item) {
      \$('input[name=\\'search_area\\']').val(item['label']);
      \$('input[name=\\'search_area_id\\']').val(item['value']);
\t  \$('input[name=\\'search_area_id_temp\\']').val(item['value']);
\t   \$('#search_alert').empty();
    }
  });
\$( \"#btn_search_area\" ).click(function() {
     var search_id = \"\";
\t\tsearch_id = \$('input[name=\\'search_area_id\\']').val();
\t\tsearch_area_id_temp = \$('input[name=\\'search_area_id_temp\\']').val();
\t\tsearch_area_name_temp = \$('input[name=\\'search_area\\']').val();
\t\t
\t\t  \$('#search_alert').empty();
\t\t  valid_data=true;
\t\t if(search_area_id_temp == \"\"){
\t\t  \$('#search_alert').css('display','block');
\t\t\t html = '<i class=\"fa fa-exclamation-circle\"></i><span> ";
                // line 199
                echo ($context["text_message"] ?? null);
                echo "</span>';
\t\t\tvalid_data = false;
\t\t \$('#search_alert').append(html);
\t\t} 
\t\t\$.ajax({
\t\t\turl: 'index.php?route=extension/purpletree_multivendor/multivendor/sellerregister|checkseller&seller_area=' + search_id,
\t\t\tdataType: 'json',\t
\t\t\ttype:'get',\t\t\t
\t\t\tsuccess: function(json) {\t
\t\t\tif(!json.status){
\t\t\t\$('#search_alert').empty();
\t\t\t\$('#search_alert').css('display','block');
\t\t\t  html = '<i class=\"fa fa-exclamation-circle\"></i><span> ";
                // line 211
                echo ($context["text_message"] ?? null);
                echo " </span>';
\t\t\t  //alert('No seller is available for this area.');
\t\t\t  valid_data = false;
\t\t\t\$('#search_alert').append(html);
\t\t\t}
\t\t\t},
\t\t\terror: function(json) {\t
\t\t\t
\t\t\t}
\t\t})
\t\t
\t\tsetTimeout(function(){

\t\tif(valid_data){
\t\t\tvar hyper_type = 1;
\t\t\thyperlocalAjax(search_id,hyper_type);
\t\t}
\t\t},500);
});


  \$('input[name=\\'search_text\\']').autocomplete({
    'source': function(request, response) {
      \$.ajax({
        url: 'index.php?route=extension/purpletree_multivendor/multivendor/common/header|seachText &search_area='+encodeURIComponent(request),
        dataType: 'json',
\t\t type: 'get',
        success: function(json) {
\t\t\t\t\$('input[name=\\'search_area_id\\']').val('');
\t\t\t\t\$('input[name=\\'search_area_id_temp\\']').val('');
\t\t\tif(Object.keys(json).length){
\t\t\t\t\$('input[name=\\'search_area_id\\']').val(json.area_id);
\t\t\t\t\$('input[name=\\'search_area_id_temp\\']').val(json.area_id);
\t\t\t}
\t\t\t
        }
      });
    }
  });
\$(\"#search_text\").keyup(function(event) {
    if (event.keyCode === 13) {
        \$(\"#btn_search_area\").click();
    }
});

</script>
<style>
.ptsc-wait {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 80;
  cursor: pointer;
}
.pts-hyperlocal-heading a {
\tcolor:#FFFFFF;
\tcursor:pointer;
\ttext-decoration: underline;
\t}
.pts-hyperlocal-heading {
  font-size:15px;
  padding:10px;
  background-color:#2198C6;
  color:#FFFFFF;
  text-align:center;
} 
.ptsc-sellerarea-hyphead{
   font-size:15px;
}
.ptsc-sellerarea-loder{
   display:none;
   width:69px;
   height:89px;
   position:absolute;
   top:50%;
   left:50%;
   padding:2px; 
   z-index: 99;
}
.ptsc-sellerarea-loderimgcol{
   color:white;
}
.ptsc-sellerarea-martr{
  margin-top:-40px !important; 
  margin-right: -4px;
}
.ptsc-quick-deliverb{
 width: 100%;
}

.pts-search-area-btn {
    width: 58px;
    height: 34px;
}
.pts-text-box-width {
\twidth: inherit !important;
}
</style>
";
            }
        }
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/catalog/view/template/multivendor/beforeheader.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  374 => 211,  359 => 199,  312 => 155,  290 => 135,  280 => 128,  278 => 127,  270 => 122,  242 => 96,  229 => 87,  219 => 82,  213 => 78,  211 => 77,  208 => 76,  193 => 65,  182 => 59,  176 => 55,  174 => 54,  171 => 53,  163 => 48,  156 => 47,  150 => 45,  146 => 44,  141 => 43,  135 => 40,  131 => 39,  128 => 38,  122 => 36,  117 => 35,  114 => 34,  111 => 33,  106 => 32,  103 => 31,  97 => 28,  94 => 27,  91 => 26,  89 => 25,  83 => 21,  81 => 20,  78 => 19,  75 => 18,  71 => 16,  68 => 15,  64 => 13,  62 => 12,  58 => 11,  49 => 5,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/catalog/view/template/multivendor/beforeheader.twig", "C:\\wamp\\www\\tutor\\extension\\purpletree_multivendor\\catalog\\view\\template\\multivendor\\beforeheader.twig");
    }
}

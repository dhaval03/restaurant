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

/* extension/purpletree_multivendor/catalog/view/template/multivendor/seatingmanagement_form.twig */
class __TwigTemplate_c076b69699c313d4690bbc42e068219e extends Template
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
        echo ($context["header"] ?? null);
        echo "
<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/bootstrap-datetimepicker.min.css\" type=\"text/css\" rel=\"stylesheet\" />
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/moment/moment.min.js\"></script>
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/moment/moment-with-locales.min.js\"></script>
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<div class=\"pts-container container\">
<div class=\"pts-row d-flex row\">";
        // line 7
        echo ($context["column_left"] ?? null);
        echo "
\t\t<div id=\"content\" class=\"pts-col-sm-9 col-sm-9 pts-col-md-9 col-md-9 pts-col-lg-10 col-lg-10 pts-col-xs-12 col-xs-12\"> 
\t\t\t<div class=\"page-header\">
\t\t\t   ";
        // line 10
        if (($context["error_warning"] ?? null)) {
            // line 11
            echo "<div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "</div>
";
        }
        // line 13
        echo "    <div class=\"container-fluid\">
     <h1>";
        // line 14
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
\t  ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 17
            echo "                <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 17);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 17);
            echo "</a></li>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "              </ul>
\t\t\t  <div class=\"pts-pull-right\">
\t\t\t<button type=\"submit\" form=\"form-attribute\" data-toggle=\"tooltip\" title=\"";
        // line 21
        echo ($context["button_save"] ?? null);
        echo "\" class=\"pts-btn pts-btn-primary\"><i class=\"fa fa-save\"></i></button>
\t\t\t<a href=\"";
        // line 22
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"pts-btn pts-btn-default\"><i class=\"fa fa-reply\"></i></a>
\t\t\t ";
        // line 23
        if (($context["helpcheck"] ?? null)) {
            // line 24
            echo "\t\t\t\t<a href=\"";
            echo ($context["helplink"] ?? null);
            echo "\" rel=”nofollow”  target=\"_blank\" id=\"button-pts-help\" class=\"btn\"><img src=\"";
            echo ($context["helpimage"] ?? null);
            echo "\" alt=\"Help\" width=\"85\" height=\"43\"></a>
\t\t\t";
        }
        // line 26
        echo "\t\t\t</div>
    </div>
  </div>

\t\t<div class=\"pts-panel pts-panel-default\">
\t\t\t<div class=\"pts-panel-heading\">
\t\t\t\t<h3 class=\"pts-panel-title\"><i class=\"fa fa-pencil fas fa-pen\"></i> ";
        // line 32
        echo ($context["text_form"] ?? null);
        echo "</h3>
\t\t\t</div>
\t\t\t<div class=\"pts-panel-body\">
\t\t\t\t<form action=\"";
        // line 35
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-attribute\" class=\"pts-form-horizontal\">
\t\t\t\t\t
\t\t\t\t\t<div class=\"pts-form-group required\">
\t\t\t\t\t\t<label class=\"pts-col-sm-2 pts-control-label\">";
        // line 38
        echo ($context["entry_tableno"] ?? null);
        echo "</label>
\t\t\t\t\t\t<div class=\"pts-col-sm-10\">
\t\t\t\t\t\t\t<input type=\"text\" name=\"table_no\" value=\"";
        // line 40
        echo ($context["table_no"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_tableno"] ?? null);
        echo "\" id=\"input-sort-order\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t";
        // line 41
        if (($context["error_table_no"] ?? null)) {
            // line 42
            echo "\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["error_table_no"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t";
        }
        // line 44
        echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t<div class=\"pts-form-group\">
\t\t\t\t\t\t<label class=\"pts-col-sm-2 pts-control-label\" for=\"input-sort-order\">";
        // line 48
        echo ($context["entry_seat"] ?? null);
        echo "</label>
\t\t\t\t\t\t<div class=\"pts-col-sm-10\">
\t\t\t\t\t\t\t<div class=\"pts-group\" data-toggle=\"buttons\">
\t\t\t\t\t\t\t\t";
        // line 51
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["seats"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["seat"]) {
            echo "\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t<label class=\"btn_default pts-btn pts-btn-default ";
            // line 52
            if (((($context["seat_capacity"] ?? null) == $context["seat"]) || (($context["seat"] == 2) && (($context["seat_capacity"] ?? null) == "")))) {
                echo " active";
            }
            echo "\">
\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"seat_capacity\" id=\"option";
            // line 53
            echo $context["seat"];
            echo "\" value=\"";
            echo $context["seat"];
            echo "\" ";
            if (((($context["seat_capacity"] ?? null) == $context["seat"]) || (($context["seat"] == 2) && (($context["seat_capacity"] ?? null) == "")))) {
                echo " checked";
            }
            echo "/> ";
            echo $context["seat"];
            echo "
\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['seat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t<div class=\"pts-form-group\">
\t\t\t\t\t\t<label class=\"pts-col-sm-2 pts-control-label\" for=\"input-storestate\">";
        // line 61
        echo ($context["entry_store"] ?? null);
        echo "</label>
\t\t\t\t\t\t<div class=\"pts-col-sm-10\">
\t\t\t\t\t\t\t<select name=\"vendor_store_id\" id=\"input-store\" class=\"pts-form-control\">
\t\t\t\t\t\t\t\t";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 65
            echo "\t\t\t\t\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 65);
            echo "\"";
            if ((twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 65) == ($context["vendor_store_id"] ?? null))) {
                echo " selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 65);
            echo "</option>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"pts-form-group\">
\t\t\t\t\t\t<label class=\"pts-col-sm-2 pts-control-label\" for=\"input-storestate\">";
        // line 71
        echo ($context["entry_location"] ?? null);
        echo "</label>
\t\t\t\t\t\t<div class=\"pts-col-sm-10\">
\t\t\t\t\t\t\t<select name=\"location\" id=\"input-location\" class=\"pts-form-control\">
\t\t\t\t\t\t\t\t";
        // line 74
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["locations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["location"]) {
            // line 75
            echo "\t\t\t\t\t\t\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["location"], "tl_id", [], "any", false, false, false, 75);
            echo "\"";
            if ((twig_get_attribute($this->env, $this->source, $context["location"], "tl_id", [], "any", false, false, false, 75) == ($context["location_id"] ?? null))) {
                echo " selected";
            }
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["location"], "name", [], "any", false, false, false, 75);
            echo "</option>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['location'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 77
        echo "\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t<div class=\"pts-form-group\">
\t\t\t\t\t\t<label class=\"pts-col-sm-2 pts-control-label\" for=\"input-attribute-group\">";
        // line 82
        echo ($context["entry_status"] ?? null);
        echo "</label>
\t\t\t\t\t\t<div class=\"pts-col-sm-10\">
\t\t\t\t\t\t\t<label class=\"switch\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\"  name=\"status\" value=\"1\" id=\"status\" data-oc-toggle=\"switch\" data-oc-target=\"#input-points\" class=\"form-check-input\"";
        // line 85
        if (($context["status"] ?? null)) {
            echo " checked";
        }
        echo "/>
\t\t\t\t\t\t\t\t<span class=\"slider round\"></span>
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t\t\t\t\t</div>
\t\t\t</div>
</div>
<style>
.switch {
\tposition: relative !important;
\tdisplay: inline-block !important;
\twidth: 60px !important;
\theight: 28px !important;
}
  
.switch input { 
\topacity: 0;
\twidth: 0;
\theight: 0;
}
  
.slider {
\tposition: absolute;
\tcursor: pointer;
\ttop: 0;
\tleft: 0;
\tright: 0;
\tbottom: 0;
\tbackground-color: #ccc;
\t-webkit-transition: .4s;
\ttransition: .4s;
}
  
.slider:before {
\tposition: absolute;
\tcontent: \"\";
\theight: 20px;
\twidth: 20px;
\tleft: 4px;
\tbottom: 4px;
\tbackground-color: white;
\t-webkit-transition: .4s;
\ttransition: .4s;
}
  
input:checked + .slider {
\tbackground-color: #2196F3;
}
  
input:focus + .slider {
\tbox-shadow: 0 0 1px #2196F3;
}
  
input:checked + .slider:before {
\t-webkit-transform: translateX(26px);
\t-ms-transform: translateX(26px);
\ttransform: translateX(26px);
}
.slider.round {
\tborder-radius: 34px;
}
  
.slider.round:before {
\tborder-radius: 50%;
}

.pts-btn-default.active {
  color: #fff !important;
  background-color: #1e91cf !important;
  border-color: #1e91cf !important;
}
.btn_default {
  color: #1e91cf !important;
  border-color: #1e91cf !important;
}
</style>

";
        // line 166
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/catalog/view/template/multivendor/seatingmanagement_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  349 => 166,  263 => 85,  257 => 82,  250 => 77,  235 => 75,  231 => 74,  225 => 71,  219 => 67,  204 => 65,  200 => 64,  194 => 61,  187 => 56,  170 => 53,  164 => 52,  158 => 51,  152 => 48,  146 => 44,  140 => 42,  138 => 41,  132 => 40,  127 => 38,  121 => 35,  115 => 32,  107 => 26,  99 => 24,  97 => 23,  91 => 22,  87 => 21,  83 => 19,  72 => 17,  68 => 16,  63 => 14,  60 => 13,  54 => 11,  52 => 10,  46 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/catalog/view/template/multivendor/seatingmanagement_form.twig", "C:\\wamp64\\www\\restaurant\\extension\\purpletree_multivendor\\catalog\\view\\template\\multivendor\\seatingmanagement_form.twig");
    }
}

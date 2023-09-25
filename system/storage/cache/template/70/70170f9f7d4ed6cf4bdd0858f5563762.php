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

/* extension/purpletree_multivendor/catalog/view/template/multivendor/seatingmanagement_list.twig */
class __TwigTemplate_110cd796f8c03301fc391e068c986702 extends Template
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
<div class=\"pts-container container\">
<div class=\"pts-row d-flex row\">";
        // line 3
        echo ($context["column_left"] ?? null);
        echo "
\t\t<div id=\"content\" class=\"pts-col-sm-9 col-sm-9 pts-col-md-9 col-md-9 pts-col-lg-10 col-lg-10 pts-col-xs-12 col-xs-12\"> 
\t\t\t<div class=\"page-header\">
\t\t\t";
        // line 6
        if (($context["error_warning"] ?? null)) {
            // line 7
            echo "    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "</div>
    ";
        }
        // line 9
        echo "    ";
        if (($context["success"] ?? null)) {
            // line 10
            echo "    <div class=\"alert pts-alert-success\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "</div>
    ";
        }
        // line 12
        echo "    <div class=\"container-fluid\">
     <h1>";
        // line 13
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
\t  ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 16
            echo "\t  <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 16);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 16);
            echo "</a></li>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "              </ul>
\t\t\t  <div class=\"pull-right float-right\"><a href=\"";
        // line 19
        echo ($context["add"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_add"] ?? null);
        echo "\" class=\"pts-btn pts-btn-primary\"><i class=\"fa fa-plus\"></i></a>
\t\t\t\t<button type=\"button\" data-toggle=\"tooltip\" title=\"";
        // line 20
        echo ($context["button_delete"] ?? null);
        echo "\" class=\"pts-btn pts-btn-danger\" onclick=\"confirm('";
        echo ($context["text_confirm"] ?? null);
        echo "') ? \$('#form-attribute').submit() : false;\"><i class=\"fa fa-trash-o fas fa-trash-alt\"></i></button>
\t\t\t\t ";
        // line 21
        if (($context["helpcheck"] ?? null)) {
            // line 22
            echo "\t\t\t\t\t<a href=\"";
            echo ($context["helplink"] ?? null);
            echo "\" rel=”nofollow”  target=\"_blank\" id=\"button-pts-help\" class=\"btn\"><img src=\"";
            echo ($context["helpimage"] ?? null);
            echo "\" alt=\"Help\" width=\"85\" height=\"43\"></a>
\t\t\t\t";
        }
        // line 24
        echo "\t\t\t</div>
    </div>
  </div>
\t\t\t
\t\t\t<form action=\"";
        // line 28
        echo ($context["delete"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-attribute\">
\t\t\t\t<div class=\"pts-table-responsive\">
\t\t\t\t\t<table class=\"pts-table pts-table-bordered pts-table-hover\">
\t\t\t\t\t\t<thead>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td class=\"text-center ptsc-attr-tab-width\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<td class=\"text-left\">
\t\t\t\t\t\t\t\t\t<a >";
        // line 36
        echo ($context["column_table_no"] ?? null);
        echo "</a>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">
\t\t\t\t\t\t\t\t\t<a>";
        // line 39
        echo ($context["column_seat"] ?? null);
        echo "</a>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">
\t\t\t\t\t\t\t\t\t<a>";
        // line 42
        echo ($context["column_status"] ?? null);
        echo "</a>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td class=\"text-right\">";
        // line 44
        echo ($context["column_action"] ?? null);
        echo "</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</thead>
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t";
        // line 48
        if (($context["seatingmanagements"] ?? null)) {
            // line 49
            echo "\t\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["seatingmanagements"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["seatingmanagement"]) {
                // line 50
                echo "\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td class=\"text-center\">";
                // line 51
                if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["seatingmanagement"], "table_id", [], "any", false, false, false, 51), ($context["selected"] ?? null))) {
                    // line 52
                    echo "\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["seatingmanagement"], "table_id", [], "any", false, false, false, 52);
                    echo "\" checked=\"checked\" />
\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 54
                    echo "\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["seatingmanagement"], "table_id", [], "any", false, false, false, 54);
                    echo "\" />
\t\t\t\t\t\t\t\t";
                }
                // line 55
                echo "</td>\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<td class=\"pts-text-left\">\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t<div class=\"table_container\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
                // line 58
                echo ($context["table_image"] ?? null);
                echo "\" style=\"width: 64px;\">
\t\t\t\t\t\t\t\t\t\t<div class=\"table_centered\"><b>";
                // line 59
                echo twig_get_attribute($this->env, $this->source, $context["seatingmanagement"], "table_no", [], "any", false, false, false, 59);
                echo "</b></div>
\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td class=\"pts-text-left\">
\t\t\t\t\t\t\t\t\t<div class=\"seat\" style=\"margin-bottom: 20px;\">
\t\t\t\t\t\t\t\t\t\t<span class=\"fa-layers fa-fw\" style=\"background:#f9f7f6;\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa fa-couch fa-2xl w-25\" style=\"z-index: 9999;position: absolute;margin-top: 13px;padding-left: 37px;\"></i>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"fa-layers-text fa-inverse\" data-fa-transform=\"shrink-8 down-3\" style=\"font-weight:900;margin-left:50px;z-index: 99999999;position: absolute;\">";
                // line 66
                echo twig_get_attribute($this->env, $this->source, $context["seatingmanagement"], "seat_capacity", [], "any", false, false, false, 66);
                echo "</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</div></td>
\t\t\t\t\t\t\t\t<td class=\"pts-text-left\">";
                // line 69
                echo twig_get_attribute($this->env, $this->source, $context["seatingmanagement"], "status", [], "any", false, false, false, 69);
                echo "</td>
\t\t\t\t\t\t\t\t<td id=\"attributeIdForSelenium\" class=\"pts-text-right\"><a href=\"";
                // line 70
                echo twig_get_attribute($this->env, $this->source, $context["seatingmanagement"], "edit", [], "any", false, false, false, 70);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil fas fa-pen\"></i></a></td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['seatingmanagement'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 73
            echo "\t\t\t\t\t\t\t";
        } else {
            // line 74
            echo "\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td class=\"text-center\" colspan=\"8\">";
            // line 75
            echo ($context["text_no_results"] ?? null);
            echo "</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t";
        }
        // line 78
        echo "\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</form>
\t\t\t<div class=\"pts-row\">
\t\t\t\t<div class=\"pts-col-sm-6 pts-text-left\">";
        // line 83
        echo ($context["pagination"] ?? null);
        echo "</div>
\t\t\t\t<div class=\"pts-col-sm-6 pts-text-right\">";
        // line 84
        echo ($context["results"] ?? null);
        echo "</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
<script>
\tfunction checkdata(e){\t\t\t
\t\tif (confirm(\"";
        // line 91
        echo ($context["text_confirm"] ?? null);
        echo "\")) {
\t\t\t} else {
\t\t\te.preventDefault();
\t\t}\t  
\t}
</script>
<style>
.table_container {
  position: relative;
  color: white;
}

.table_centered {
  position: absolute;
  top: 30%;
  left: 12%;
  transform: translate(-50%, -50%);
  color: #212529;
}
</style>
";
        // line 111
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/catalog/view/template/multivendor/seatingmanagement_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  274 => 111,  251 => 91,  241 => 84,  237 => 83,  230 => 78,  224 => 75,  221 => 74,  218 => 73,  207 => 70,  203 => 69,  197 => 66,  187 => 59,  183 => 58,  178 => 55,  172 => 54,  166 => 52,  164 => 51,  161 => 50,  156 => 49,  154 => 48,  147 => 44,  142 => 42,  136 => 39,  130 => 36,  119 => 28,  113 => 24,  105 => 22,  103 => 21,  97 => 20,  91 => 19,  88 => 18,  77 => 16,  73 => 15,  68 => 13,  65 => 12,  59 => 10,  56 => 9,  50 => 7,  48 => 6,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/catalog/view/template/multivendor/seatingmanagement_list.twig", "C:\\wamp64\\www\\restaurant\\extension\\purpletree_multivendor\\catalog\\view\\template\\multivendor\\seatingmanagement_list.twig");
    }
}

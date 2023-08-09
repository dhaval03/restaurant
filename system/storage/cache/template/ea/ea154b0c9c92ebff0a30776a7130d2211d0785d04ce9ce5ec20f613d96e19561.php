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

/* extension/purpletree_multivendor/catalog/view/template/multivendor/header.twig */
class __TwigTemplate_9dd927dd8063d3aaa0177f68b7987958062dec8a8a97c52b34ae9ce8fcd8df03 extends Template
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
        echo "<!DOCTYPE html>
<html dir=\"";
        // line 2
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\">
<head>
<meta charset=\"UTF-8\" />
<title> ";
        // line 5
        echo ($context["heading_title1"] ?? null);
        echo "</title>
<base href=\"";
        // line 6
        echo ($context["base"] ?? null);
        echo "\" />
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0\" />
";
        // line 8
        if (($context["description"] ?? null)) {
            // line 9
            echo "<meta name=\"description\" content=\"";
            echo ($context["description"] ?? null);
            echo "\" />
";
        }
        // line 11
        if (($context["keywords"] ?? null)) {
            // line 12
            echo "<meta name=\"keywords\" content=\"";
            echo ($context["keywords"] ?? null);
            echo "\" />
";
        }
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stylespts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["stylepts"]) {
            // line 15
            echo "<link href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["stylepts"], "href", [], "any", false, false, false, 15);
            echo "\" type=\"text/css\" rel=\"";
            echo twig_get_attribute($this->env, $this->source, $context["stylepts"], "rel", [], "any", false, false, false, 15);
            echo "\" media=\"";
            echo twig_get_attribute($this->env, $this->source, $context["stylepts"], "media", [], "any", false, false, false, 15);
            echo "\" />
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['stylepts'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/bootstrap/css/bootstrap.css\" type=\"text/css\" rel=\"stylesheet\" />
<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/font-awesome/css/font-awesome.min.css\" type=\"text/css\" rel=\"stylesheet\" />
<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/bootstrap-datetimepicker.min.css\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />

<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/jquery-2.1.1.min.js\"></script>
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/bootstrap/js/bootstrap.min.js\"></script>
<script src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/moment/moment.min.js\" type=\"text/javascript\"></script>
<script src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/moment/moment-with-locales.min.js\" type=\"text/javascript\"></script>
<script src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/bootstrap-datetimepicker.min.js\" type=\"text/javascript\"></script>
<link href=\"extension/purpletree_multivendor/catalog/view/assets/css/commonstylesheet.css\" type=\"text/css\" rel=\"stylesheet\" />

<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/bootstrap1/css/bootstrap.css\" type=\"text/css\" rel=\"stylesheet\" />
<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/font-awesome/css/font-awesome.min.css\" type=\"text/css\" rel=\"stylesheet\" />
<script src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/moment/moment.min.js\" type=\"text/javascript\"></script>
<script src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/moment/moment-with-locales.min.js\" type=\"text/javascript\"></script>
<script src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/bootstrap-datetimepicker.min.js\" type=\"text/javascript\"></script>
<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/bootstrap-datetimepicker.min.css\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />
";
        // line 34
        if ((($context["direction"] ?? null) == "rtl")) {
            // line 35
            echo "<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/bootstrap/css/bootstrap.min-a.css\" type=\"text/css\" rel=\"stylesheet\" />
<link href=\"extension/purpletree_multivendor/catalog/view/assets/css/custom-a.css\" type=\"text/css\" rel=\"stylesheet\" />
<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/css/stylesheet/adminstylesheet-a.css\" type=\"text/css\" rel=\"stylesheet\" />
";
        } else {
            // line 39
            echo "<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/bootstrap/css/bootstrap.min.css\" type=\"text/css\" rel=\"stylesheet\" />
<link href=\"extension/purpletree_multivendor/catalog/view/assets/css/custom.css\" type=\"text/css\" rel=\"stylesheet\" />
<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/css/stylesheet/adminstylesheet.css\" type=\"text/css\" rel=\"stylesheet\" />
";
        }
        // line 43
        echo "<link href=\"extension/purpletree_multivendor/catalog/view/assets/css/commonstylesheet.css\" type=\"text/css\" rel=\"stylesheet\" />

<script src=\"extension/purpletree_multivendor/catalog/view/assets/library/common.js\" type=\"text/javascript\"></script>
";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["links"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 47
            echo "<link href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["link"], "href", [], "any", false, false, false, 47);
            echo "\" rel=\"";
            echo twig_get_attribute($this->env, $this->source, $context["link"], "rel", [], "any", false, false, false, 47);
            echo "\" />
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["analytics"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["analytic"]) {
            // line 50
            echo $context["analytic"];
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['analytic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "<script src=\"catalog/view/javascript/common.js\" type=\"text/javascript\"></script>
</head>
<body> 
<body> 
<div id=\"container\">
<header id=\"header\" class=\"navbar navbar-static-top\">
  <div class=\"container-fluid\">
    <div id=\"header-logo\" class=\"pts-navbar-header\">";
        // line 59
        if (($context["logo"] ?? null)) {
            echo "<a class=\"pts-pull-left navbar-brand ptsc-header-padding\" href=\"";
            echo ($context["home"] ?? null);
            echo "\"  /><img src=\"";
            echo ($context["logo"] ?? null);
            echo "\" title=\"";
            echo ($context["name"] ?? null);
            echo "\" alt=\"";
            echo ($context["name"] ?? null);
            echo "\" class=\"img-responsive ptsc-header-height\" /></a>";
        } else {
            // line 60
            echo "          <h1><a  class=\"pts-pull-left navbar-brand\" href=\"";
            echo ($context["home"] ?? null);
            echo "\">";
            echo ($context["name"] ?? null);
            echo "</a></h1>
          ";
        }
        // line 61
        echo "</div>

    <a href=\"#\" id=\"button-menu\" class=\"hidden-md hidden-lg\"><span class=\"fa fa-bars\"></span></a>
\t\t";
        // line 64
        if (($context["logged"] ?? null)) {
            // line 65
            echo "    <ul class=\"nav navbar-nav pts-navbar-nav pts-navbar-right pts-pull-right accountptsdrop\">
      <li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><img src=\"";
            // line 66
            echo ($context["image"] ?? null);
            echo "\" alt=\"";
            echo ($context["firstname"] ?? null);
            echo " ";
            echo ($context["lastname"] ?? null);
            echo "\" title=\"";
            echo ($context["username"] ?? null);
            echo "\" id=\"user-profile\" class=\"img-circle\" />";
            echo ($context["firstname"] ?? null);
            echo " ";
            echo ($context["lastname"] ?? null);
            echo " <i class=\"fa fa-caret-down fa-fw\"></i></a>
        <ul class=\"pts-dropdown-menu pts-dropdown-menu-right\">
             <li><a target=\"_blank\" href=\"";
            // line 68
            echo ($context["sellerprofile"] ?? null);
            echo "\"><i class=\"fa fa-user\"></i> ";
            echo ($context["text_sellerprofile"] ?? null);
            echo "</a></li>
\t\t\t ";
            // line 69
            if (($context["storename"] ?? null)) {
                // line 70
                echo "          <li class=\"dropdown-header\">";
                echo ($context["text_store"] ?? null);
                echo "</li>
          <li><a href=\"";
                // line 71
                echo ($context["storeurl"] ?? null);
                echo "\" target=\"_blank\">";
                echo ($context["storename"] ?? null);
                echo "</a></li>
\t\t  ";
            }
            // line 73
            echo "        </ul>
      </li>
      <li><a href=\"";
            // line 75
            echo ($context["logout"] ?? null);
            echo "\"><i class=\"fa fa-sign-out\"></i> <span class=\"hidden-xs hidden-sm hidden-md\">";
            echo ($context["text_logout"] ?? null);
            echo "</span></a></li>
    </ul>
    ";
        }
        // line 78
        echo "\t<div class=\"ptssellertop pts-pull-right\">
\t\t";
        // line 79
        echo ($context["currency"] ?? null);
        echo "
\t\t";
        // line 80
        echo ($context["language"] ?? null);
        echo "
\t</div>
  </div>
</header>";
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/catalog/view/template/multivendor/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  248 => 80,  244 => 79,  241 => 78,  233 => 75,  229 => 73,  222 => 71,  217 => 70,  215 => 69,  209 => 68,  194 => 66,  191 => 65,  189 => 64,  184 => 61,  176 => 60,  164 => 59,  155 => 52,  147 => 50,  143 => 49,  132 => 47,  128 => 46,  123 => 43,  117 => 39,  111 => 35,  109 => 34,  90 => 17,  77 => 15,  73 => 14,  67 => 12,  65 => 11,  59 => 9,  57 => 8,  52 => 6,  48 => 5,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/catalog/view/template/multivendor/header.twig", "C:\\wamp\\www\\tutor\\extension\\purpletree_multivendor\\catalog\\view\\template\\multivendor\\header.twig");
    }
}

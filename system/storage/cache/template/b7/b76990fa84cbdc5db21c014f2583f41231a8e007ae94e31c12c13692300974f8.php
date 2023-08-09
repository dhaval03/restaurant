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

/* extension/purpletree_multivendor/admin/view/template/multivendor/upgrade_database.twig */
class __TwigTemplate_c877e9cc9980a84a1efb3804bf9f16289cef1f99742a620d8383c162ec487af6 extends Template
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
";
        // line 2
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\">
\t<div class=\"page-header\">
\t\t<div class=\"container-fluid\">
\t\t\t";
        // line 6
        if (($context["helpcheck"] ?? null)) {
            // line 7
            echo "\t\t\t<div class=\"pull-right float-end\">
\t\t\t\t<a href=\"";
            // line 8
            echo ($context["helplink"] ?? null);
            echo "\" rel=”nofollow”  target=\"_blank\" id=\"button-pts-help\" class=\"btn\"><img src=\"";
            echo ($context["helpimage"] ?? null);
            echo "\" alt=\"Help\" width=\"85\" height=\"43\"></a>
\t\t\t</div>
\t\t";
        }
        // line 11
        echo "\t\t\t<h1>";
        echo ($context["heading_title"] ?? null);
        echo "</h1>
\t\t\t<ul class=\"breadcrumb\">
\t\t\t\t";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 14
            echo "\t\t\t\t<li class=\"breadcrumb-item\"><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 14);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 14);
            echo "</a></li>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "\t\t\t</ul>
\t\t</div>
\t</div>
\t<div class=\"container-fluid\">
\t\t";
        // line 20
        if (($context["error_warning"] ?? null)) {
            // line 21
            echo "\t\t<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t\t\t<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
\t\t</div>
\t\t";
        }
        // line 25
        echo "\t   ";
        if (($context["success"] ?? null)) {
            // line 26
            echo "\t\t<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
\t\t\t<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
\t\t</div>
\t\t";
        }
        // line 30
        echo "\t\t<div class=\"panel panel-default card\">
\t\t\t<div class=\"panel-heading\">
\t\t\t\t<h3 class=\"panel-title card-header\"><i class=\"fa fa-list\"></i> ";
        // line 32
        echo ($context["text_upgrade_database"] ?? null);
        echo "</h3>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"panel-body card-body\">
\t\t\t\t<form action=\"";
        // line 36
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-customer\">
\t\t\t\t\t<div class=\"well card mb-3 p-3\">
\t\t\t\t\t\t<div class=\"row\">\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<label class=\"control-label ptsc-upgrdatabas-textpadd\" for=\"input-name\"><h5>";
        // line 39
        echo ($context["text_upgrade_info"] ?? null);
        echo "<h5></label>
\t\t\t\t\t\t\t<div class=\"col-sm-12 text-left\">
\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t<a href=\"";
        // line 42
        echo ($context["url"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_Upgrade"] ?? null);
        echo "\"><input type=\"button\" value=\"";
        echo ($context["button_Upgrade"] ?? null);
        echo "\" class=\"btn btn-primary\" class=\"button_add ptsc-upgrdatabas-padd\" ></a>
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>       
\t\t</div>
\t</div>
</div>

";
        // line 55
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/admin/view/template/multivendor/upgrade_database.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 55,  132 => 42,  126 => 39,  120 => 36,  113 => 32,  109 => 30,  101 => 26,  98 => 25,  90 => 21,  88 => 20,  82 => 16,  71 => 14,  67 => 13,  61 => 11,  53 => 8,  50 => 7,  48 => 6,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/admin/view/template/multivendor/upgrade_database.twig", "C:\\wamp\\www\\tutor\\extension\\purpletree_multivendor\\admin\\view\\template\\multivendor\\upgrade_database.twig");
    }
}

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

/* extension/purpletree_multivendor/catalog/view/template/multivendor/sellerlogin.twig */
class __TwigTemplate_91fa4f7c0c9dcf4021824bdeaa9a88ebdbf6743611aaa5c92f8c618d4ec3821d extends Template
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
<div id=\"content\">
  <div class=\"container-fluid\">
  <br>
    <br>
    <div class=\"row\">
\t\t\t\t<div class=\"col-md-offset-4 col-md-4\">
\t\t\t\t<div id=\"alert\"><button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button></div>
\t\t\t\t\t<div class=\"pts-well seller-login-form\">
\t\t\t\t\t\t<h2 class=\"text-center\">";
        // line 10
        echo ($context["text_seller_login"] ?? null);
        echo "</h2>
\t\t\t\t\t\t<form id=\"form-login\" action=\"";
        // line 11
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" data-oc-toggle=\"ajax\">
\t\t\t\t\t\t\t<div class=\"pts-form-group\">
\t\t\t\t\t\t\t\t<label class=\"pts-control-label col-form-label\" for=\"seller-email\">";
        // line 13
        echo ($context["entry_email"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t<input type=\"text\" name=\"email\" value=\"";
        // line 14
        echo ($context["email"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_email"] ?? null);
        echo "\" id=\"seller-email\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"pts-form-group \">
\t\t\t\t\t\t\t\t<label class=\"pts-control-label col-form-label\" for=\"seller-password\">";
        // line 17
        echo ($context["entry_password"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t<input type=\"password\" name=\"password\" value=\"";
        // line 18
        echo ($context["password"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_password"] ?? null);
        echo "\" id=\"seller-password\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<a href=\"";
        // line 20
        echo ($context["forgotten"] ?? null);
        echo "\">";
        echo ($context["text_forgotten"] ?? null);
        echo "</a>
\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t<div class=\"pts-col-sm-5 pts-pull-left-1  pts-mt-3\">
\t\t\t\t\t\t\t\t\t<input id=\"seller-login-button\" type=\"submit\" value=\"";
        // line 23
        echo ($context["button_login"] ?? null);
        echo "\" class=\"pts-btn pts-btn-primary\" />
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"pts-pr-3 text-center pts-pull-right-1 pts-mt-3\">
\t\t\t\t\t\t\t\t\t<p class=\"new-seller-register-here\"><span class=\"login-seller\" ><i class=\"fa fa-user-o fa-users\"></i> ";
        // line 26
        echo ($context["text_new_seller"] ?? null);
        echo "  </span><a href=\"";
        echo ($context["sellerregister"] ?? null);
        echo "\" class=\"ptsc-sregister-sellog\" id=\"pts-reg-seller\"> ";
        echo ($context["text_register_new"] ?? null);
        echo " </a></p>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        // line 29
        if (($context["redirect"] ?? null)) {
            // line 30
            echo "\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"redirect\" value=\"";
            echo ($context["redirect"] ?? null);
            echo "\" />
\t\t\t\t\t\t\t\t";
        }
        // line 32
        echo "\t\t\t\t\t\t\t</form>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t</div>
</div>
<style>
#button-menu {
\tdisplay: none;
}
.btn-close {
\tdisplay:none;
}
</style>

";
        // line 47
        echo ($context["footer"] ?? null);
        echo "      ";
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/catalog/view/template/multivendor/sellerlogin.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 47,  113 => 32,  107 => 30,  105 => 29,  95 => 26,  89 => 23,  81 => 20,  74 => 18,  70 => 17,  62 => 14,  58 => 13,  53 => 11,  49 => 10,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/catalog/view/template/multivendor/sellerlogin.twig", "C:\\wamp\\www\\tutor\\extension\\purpletree_multivendor\\catalog\\view\\template\\multivendor\\sellerlogin.twig");
    }
}

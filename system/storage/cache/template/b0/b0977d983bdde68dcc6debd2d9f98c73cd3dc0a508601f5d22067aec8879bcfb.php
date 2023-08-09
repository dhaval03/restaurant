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

/* extension/purpletree_multivendor/catalog/view/template/multivendor/footer.twig */
class __TwigTemplate_cf03581016c6a7a4f2d9bcd665357a60c197d2de6509b86a956987da8801711b extends Template
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
        echo "<footer id=\"footer\">";
        echo ($context["text_footer"] ?? null);
        echo "<br />";
        echo ($context["text_version"] ?? null);
        echo "</footer></div>
<script>
\$(document).on('click','.note-insert button',function(){ 
\t\$('.modal-backdrop.in').css(\"display\",\"none\");
});
\$(document).on('click','.note-link button',function(){ 
\t\$('.modal-backdrop.in').css(\"display\",\"none\");
});
</script>
</body></html>
";
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/catalog/view/template/multivendor/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/catalog/view/template/multivendor/footer.twig", "C:\\wamp\\www\\tutor\\extension\\purpletree_multivendor\\catalog\\view\\template\\multivendor\\footer.twig");
    }
}

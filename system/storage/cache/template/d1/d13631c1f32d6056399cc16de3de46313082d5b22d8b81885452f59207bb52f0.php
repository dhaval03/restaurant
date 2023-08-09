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

/* extension/purpletree_multivendor/catalog/view/template/multivendor/sellerregister.twig */
class __TwigTemplate_c5d1efe2a4dbde978b1ad3c098fc7c86dde93b66521a0b689141973a10f030d7 extends Template
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
<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/codemirror/lib/codemirror.css\" type=\"text/css\" rel=\"stylesheet\" />
<link href=\"extension/purpletree_multivendor/catalog/view/assets/library/codemirror/theme/monokai.css\" type=\"text/css\" rel=\"stylesheet\" />

<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/moment/moment.min.js\"></script>
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/moment/moment-with-locales.min.js\"></script>
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/jquery/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/codemirror/lib/codemirror.js\"></script>
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/codemirror/lib/xml.js\"></script>
<script type=\"text/javascript\" src=\"extension/purpletree_multivendor/catalog/view/assets/library/codemirror/lib/formatting.js\"></script>
<div id=\"content\">
  <div class=\"container-fluid\"><br>
    <br>
    <div class=\"row\">
\t\t\t\t<div class=\"col-sm-offset-3 col-sm-6\">
\t\t\t\t  ";
        // line 18
        if (($context["success"] ?? null)) {
            // line 19
            echo "\t<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "</div>
\t";
        }
        // line 21
        echo "\t";
        if (($context["error_warning"] ?? null)) {
            // line 22
            echo "\t<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "</div>
\t";
        }
        // line 23
        echo " 
\t\t\t<form action=\"\" method=\"post\" name=\"sellerregForm\" id=\"regForm\" enctype=\"multipart/form-data\" class=\"form-horizontal\">
\t\t\t\t\t\t<h2 class=\"text-center\">";
        // line 25
        echo ($context["text_seller_register_page"] ?? null);
        echo "</h2>
\t\t\t\t\t\t<hr class=\"ptsc-sregister-sellregtxt\">
\t\t\t\t\t\t<div class=\"head_steps text-center\">
\t\t\t\t\t\t\t<span class=\"step step-one \">
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"step-icon\"><i class=\"fa fa-pencil fa-edit fas fa-pen\"></i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<p> ";
        // line 32
        echo ($context["text_personal_details"] ?? null);
        echo "</p>
\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t<span class=\"step step-two\">
\t\t\t\t\t\t\t\t<div class=\"step-icon\"><i class=\"fa fa-user-o fa-users\"></i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<p> ";
        // line 37
        echo ($context["text_seller_information1"] ?? null);
        echo "</p>
\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t<span class=\"step step-three\">
\t\t\t\t\t\t\t\t<div class=\"step-icon\"><i class=\"fa fa-credit-card\"></i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<p> ";
        // line 42
        echo ($context["text_payment_details1"] ?? null);
        echo "</p>
\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"pts-well seller-rgistration-form\">
\t\t\t\t\t\t\t<div class=\"pts-col-md-12 p-0\">
\t\t\t\t\t\t\t\t<div class=\" pts-col-md-7 pts-pull-left-1 p-0\">
\t\t\t\t\t\t\t\t\t<p class=\"new-seller-login-here\"><span class=\"login-seller\"><i class=\"fa fa-user-o fa-users\"></i>   ";
        // line 48
        echo ($context["text_new_customer_register"] ?? null);
        echo "  </span><a href=\"";
        echo ($context["sellerlogin"] ?? null);
        echo "\" class=\"ptsc-sregister-sellog\"> ";
        echo ($context["text_seller_login1"] ?? null);
        echo " </a><span></span></p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\" pts-col-md-5  pts-pull-right-1 p-0\">
\t\t\t\t\t\t\t\t\t<div class=\"ptsc-sregister-overflow\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ptsc-subpl-florig\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" id=\"prevBtn\" class=\"pts-btn pts-btn-sm pts-btn-default\" onclick=\"nextPrev(-1)\">";
        // line 53
        echo ($context["btn_prev"] ?? null);
        echo "</button>
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" id=\"nextBtn\" class=\"pts-btn pts-btn-sm pts-btn-primary\" onclick=\"nextPrev(1)\">";
        // line 54
        echo ($context["btn_next"] ?? null);
        echo "</button>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<hr class=\"ptsc-sregister-hr\">
\t\t\t\t\t\t\t<!--personal data-->
\t\t\t\t\t\t\t<div class=\"tab\">
\t\t\t\t\t\t\t\t";
        // line 62
        if ((($context["loggedcus"] ?? null) == "")) {
            // line 63
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row ptsc-productl-nodisplay\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group required ptsradioinp ";
            // line 64
            if ((twig_length_filter($this->env, ($context["customer_groups"] ?? null)) > 1)) {
                echo " ptsc-productl-blodisplay ";
            } else {
                echo " ptsc-productl-nodisplay ";
            }
            echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-col-sm-2 pts-control-label\">";
            // line 65
            echo ($context["entry_customer_group"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"pts-col-sm-10\">";
            // line 66
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
                // line 67
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                if ((twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 67) == ($context["customer_group_id"] ?? null))) {
                    // line 68
                    echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"radio\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"customer_group_id\" value=\"";
                    // line 70
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 70);
                    echo "\" checked=\"checked\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 71
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 71);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 74
                    echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"radio\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"customer_group_id\" value=\"";
                    // line 76
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 76);
                    echo "\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 77
                    echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 77);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 80
                echo "\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"pts-row \">
\t\t\t\t\t\t\t\t\t<div class=\"pts-col-md-6 pts-form-group required\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-firstname\">";
            // line 85
            echo ($context["entry_firstname"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"firstname\" value=\"";
            // line 86
            echo ($context["firstname"] ?? null);
            echo "\" placeholder=\"";
            echo ($context["entry_firstname"] ?? null);
            echo "\" id=\"input-firstname\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t\t";
            // line 87
            if (($context["error_firstname"] ?? null)) {
                // line 88
                echo "\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
                echo ($context["error_firstname"] ?? null);
                echo "</div>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 89
            echo " 
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"pts-col-md-6 pts-form-group required\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-lastname\">";
            // line 92
            echo ($context["entry_lastname"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"lastname\" value=\"";
            // line 93
            echo ($context["lastname"] ?? null);
            echo "\" placeholder=\"";
            echo ($context["entry_lastname"] ?? null);
            echo "\" id=\"input-lastname\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t\t";
            // line 94
            if (($context["error_lastname"] ?? null)) {
                // line 95
                echo "\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
                echo ($context["error_lastname"] ?? null);
                echo "</div>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 97
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"pts-form-group required\">
\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-email\">";
            // line 101
            echo ($context["entry_email"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<input type=\"email\" name=\"email\" value=\"";
            // line 102
            echo ($context["email"] ?? null);
            echo "\" placeholder=\"";
            echo ($context["entry_email"] ?? null);
            echo "\" id=\"input-email\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t";
            // line 103
            if (($context["error_email"] ?? null)) {
                // line 104
                echo "\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
                echo ($context["error_email"] ?? null);
                echo "</div>
\t\t\t\t\t\t\t\t\t";
            }
            // line 106
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"pts-form-group required\">
\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-password\">";
            // line 109
            echo ($context["entry_password"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<input type=\"password\" name=\"password\" value=\"";
            // line 110
            echo ($context["password"] ?? null);
            echo "\" placeholder=\"";
            echo ($context["entry_password"] ?? null);
            echo "\" id=\"password\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t";
            // line 111
            if (($context["error_password"] ?? null)) {
                // line 112
                echo "\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
                echo ($context["error_password"] ?? null);
                echo "</div>
\t\t\t\t\t\t\t\t\t";
            }
            // line 114
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"pts-form-group required\">
\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-confirm\">";
            // line 117
            echo ($context["entry_confirm"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<input type=\"password\" name=\"confirm\" value=\"";
            // line 118
            echo ($context["confirm"] ?? null);
            echo "\" placeholder=\"";
            echo ($context["entry_confirm"] ?? null);
            echo "\" id=\"confirm\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t";
            // line 119
            if (($context["error_confirm"] ?? null)) {
                // line 120
                echo "\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
                echo ($context["error_confirm"] ?? null);
                echo "</div>
\t\t\t\t\t\t\t\t\t";
            }
            // line 122
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"pts-form-group required\">
\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-telephone\">";
            // line 125
            echo ($context["entry_telephone"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<input type=\"tel\" name=\"telephone\" value=\"";
            // line 126
            echo ($context["telephone"] ?? null);
            echo "\" placeholder=\"";
            echo ($context["entry_telephone"] ?? null);
            echo "\" id=\"input-telephone\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t";
            // line 127
            if (($context["error_telephone"] ?? null)) {
                // line 128
                echo "\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
                echo ($context["error_telephone"] ?? null);
                echo "</div>
\t\t\t\t\t\t\t\t\t";
            }
            // line 130
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"pts-form-group p-0\">
\t\t\t\t\t\t\t\t\t";
            // line 132
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["custom_fields"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["custom_field"]) {
                // line 133
                echo "\t\t\t\t\t\t\t\t\t ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 133) == "select")) {
                    // line 134
                    echo "\t\t\t\t\t\t\t\t\t  ";
                    if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 134) == "one")) {
                        // line 135
                        echo "\t\t\t\t\t\t\t\t\t  <div ";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 135)) {
                            echo " required ";
                        }
                        echo " id=\"custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 135);
                        echo "\" class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 135)) {
                            echo " required ";
                        }
                        echo "  pts-form-group pts-col-md-12 p-0\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                        // line 136
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 136);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 136);
                        echo "</label>
\t\t\t\t\t\t\t\t\t 
\t\t\t\t\t\t\t\t\t\t  <select name=\"custom_field[";
                        // line 138
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 138);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 138);
                        echo "]\" id=\"input-custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 138);
                        echo "\" class=\"pts-form-control\">
\t\t\t\t\t\t\t\t\t\t\t<option value=\"\">";
                        // line 139
                        echo ($context["text_select"] ?? null);
                        echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                        // line 140
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 140));
                        foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                            // line 141
                            echo "\t\t\t\t\t\t\t\t\t\t\t";
                            if (((($__internal_compile_0 = (($__internal_compile_1 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 141)] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 141)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 141) == (($__internal_compile_2 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 141)] ?? null) : null)))) {
                                // line 142
                                echo "\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 142);
                                echo "\" selected=\"selected\">";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 142);
                                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                            } else {
                                // line 144
                                echo "\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 144);
                                echo "\">";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 144);
                                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 146
                            echo "\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        echo " 
\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t  ";
                        // line 148
                        if ((($__internal_compile_3 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 148)] ?? null) : null)) {
                            // line 149
                            echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                            echo (($__internal_compile_4 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 149)] ?? null) : null);
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 151
                        echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 153
                    echo "\t\t\t\t\t\t\t\t\t";
                }
                // line 154
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 154) == "radio")) {
                    // line 155
                    echo "\t\t\t\t\t\t\t\t\t   ";
                    if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 155) == "one")) {
                        // line 156
                        echo "\t\t\t\t\t\t\t\t\t  <div ";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 156)) {
                            echo " required ";
                        }
                        echo " id=\"custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 156);
                        echo "\" class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 156)) {
                            echo " required ";
                        }
                        echo "  pts-form-group pts-col-md-12 p-0 ptsradioinp\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\">";
                        // line 157
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 157);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t  <div> ";
                        // line 158
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 158));
                        foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                            // line 159
                            echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"radio\">";
                            if (((($__internal_compile_5 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 159)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 159) == (($__internal_compile_6 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 159)] ?? null) : null)))) {
                                // line 160
                                echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"custom_field[";
                                // line 161
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 161);
                                echo "][";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 161);
                                echo "]\" value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 161);
                                echo "\" checked=\"checked\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                                // line 162
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 162);
                                echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                            } else {
                                // line 164
                                echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"custom_field[";
                                // line 165
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 165);
                                echo "][";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 165);
                                echo "]\" value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 165);
                                echo "\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                                // line 166
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 166);
                                echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                            }
                            // line 167
                            echo " </div>
\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 168
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                        // line 169
                        if ((($__internal_compile_7 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 169)] ?? null) : null)) {
                            // line 170
                            echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                            echo (($__internal_compile_8 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 170)] ?? null) : null);
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 172
                        echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 174
                    echo "\t\t\t\t\t\t\t\t\t  ";
                }
                // line 175
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 175) == "checkbox")) {
                    // line 176
                    echo "\t\t\t\t\t\t\t\t\t   ";
                    if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 176) == "one")) {
                        // line 177
                        echo "\t\t\t\t\t\t\t\t\t  <div ";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 177)) {
                            echo " required ";
                        }
                        echo " id=\"custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 177);
                        echo "\" class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 177)) {
                            echo " required ";
                        }
                        echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 177);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\">";
                        // line 178
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 178);
                        echo "</label>
\t\t\t\t\t\t\t\t   
\t\t\t\t\t\t\t\t\t\t  <div> ";
                        // line 180
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 180));
                        foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                            // line 181
                            echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">";
                            if (((($__internal_compile_9 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 181)] ?? null) : null) && twig_in_filter(twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 181), (($__internal_compile_10 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 181)] ?? null) : null)))) {
                                // line 182
                                echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"custom_field[";
                                // line 183
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 183);
                                echo "][";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 183);
                                echo "][]\" value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 183);
                                echo "\" checked=\"checked\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                                // line 184
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 184);
                                echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                            } else {
                                // line 186
                                echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"custom_field[";
                                // line 187
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 187);
                                echo "][";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 187);
                                echo "][]\" value=\"";
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 187);
                                echo "\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                                // line 188
                                echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 188);
                                echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                            }
                            // line 189
                            echo " </div>
\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 190
                        echo " </div>
\t\t\t\t\t\t\t\t\t\t  ";
                        // line 191
                        if ((($__internal_compile_11 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 191)] ?? null) : null)) {
                            // line 192
                            echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                            echo (($__internal_compile_12 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 192)] ?? null) : null);
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 194
                        echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 196
                    echo "\t\t\t\t\t\t\t\t\t  ";
                }
                // line 197
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 197) == "text")) {
                    // line 198
                    echo "\t\t\t\t\t\t\t\t\t   ";
                    if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 198) == "one")) {
                        // line 199
                        echo "\t\t\t\t\t\t\t\t\t  <div ";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 199)) {
                            echo " required ";
                        }
                        echo " id=\"custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 199);
                        echo "\" class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 199)) {
                            echo " required ";
                        }
                        echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 199);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                        // line 200
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 200);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 200);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t  <input type=\"text\" name=\"custom_field[";
                        // line 201
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 201);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 201);
                        echo "]\" value=\"";
                        if ((($__internal_compile_13 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 201)] ?? null) : null)) {
                            echo (($__internal_compile_14 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 201)] ?? null) : null);
                        } else {
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 201);
                        }
                        echo "\" placeholder=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 201);
                        echo "\" id=\"input-custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 201);
                        echo "\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t\t  ";
                        // line 202
                        if ((($__internal_compile_15 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 202)] ?? null) : null)) {
                            // line 203
                            echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                            echo (($__internal_compile_16 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 203)] ?? null) : null);
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 205
                        echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 207
                    echo "\t\t\t\t\t\t\t\t\t  ";
                }
                // line 208
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 208) == "textarea")) {
                    // line 209
                    echo "\t\t\t\t\t\t\t\t\t   ";
                    if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 209) == "one")) {
                        // line 210
                        echo "\t\t\t\t\t\t\t\t\t   <div ";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 210)) {
                            echo " required ";
                        }
                        echo " id=\"custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 210);
                        echo "\" class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 210)) {
                            echo " required ";
                        }
                        echo "  pts-form-group custom-field\" data-sort=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 210);
                        echo "\">
\t\t\t\t\t\t\t\t\t  <label class=\"pts-control-label\" for=\"input-custom-field";
                        // line 211
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 211);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 211);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t<textarea name=\"custom_field[";
                        // line 212
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 212);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 212);
                        echo "]\" class=\"pts-form-control\" rows=\"5\" placeholder=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 212);
                        echo "\" id=\"input-custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 212);
                        echo "\">";
                        echo ($context["store_address"] ?? null);
                        if ((($__internal_compile_17 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 212)] ?? null) : null)) {
                            echo (($__internal_compile_18 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 212)] ?? null) : null);
                        } else {
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 212);
                        }
                        echo "</textarea>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 215
                    echo "\t\t\t\t\t\t\t\t\t  ";
                }
                // line 216
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 216) == "file")) {
                    // line 217
                    echo "\t\t\t\t\t\t\t\t\t   ";
                    if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 217) == "one")) {
                        // line 218
                        echo "\t\t\t\t\t\t\t\t\t  <div ";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 218)) {
                            echo " required ";
                        }
                        echo " id=\"custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 218);
                        echo "\" class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 218)) {
                            echo " required ";
                        }
                        echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 218);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\">";
                        // line 219
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 219);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t  <button type=\"button\" id=\"button-custom-field";
                        // line 220
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 220);
                        echo "\" data-loading-text=\"";
                        echo ($context["text_loading"] ?? null);
                        echo "\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-upload\"></i> ";
                        echo ($context["button_upload"] ?? null);
                        echo "</button>
\t\t\t\t\t\t\t\t\t\t  <input type=\"hidden\" name=\"custom_field[";
                        // line 221
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 221);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 221);
                        echo "]\" value=\"";
                        if ((($__internal_compile_19 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 221)] ?? null) : null)) {
                            echo "  ";
                            echo (($__internal_compile_20 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 221)] ?? null) : null);
                            echo " ";
                        }
                        echo "\" />
\t\t\t\t\t\t\t\t\t\t  ";
                        // line 222
                        if ((($__internal_compile_21 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 222)] ?? null) : null)) {
                            // line 223
                            echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                            echo (($__internal_compile_22 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 223)] ?? null) : null);
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 225
                        echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 227
                    echo "\t\t\t\t\t\t\t\t\t  ";
                }
                // line 228
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 228) == "date")) {
                    // line 229
                    echo "\t\t\t\t\t\t\t\t\t   ";
                    if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 229) == "one")) {
                        // line 230
                        echo "\t\t\t\t\t\t\t\t\t  <div ";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 230)) {
                            echo " required ";
                        }
                        echo " id=\"custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 230);
                        echo "\" class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 230)) {
                            echo " required ";
                        }
                        echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 230);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                        // line 231
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 231);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 231);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t  <div class=\"input-group date\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"custom_field[";
                        // line 233
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 233);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 233);
                        echo "]\" value=\"";
                        if ((($__internal_compile_23 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 233)] ?? null) : null)) {
                            echo (($__internal_compile_24 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 233)] ?? null) : null);
                        } else {
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 233);
                        }
                        echo "\" placeholder=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 233);
                        echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 233);
                        echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-calendar\"></i></button>
\t\t\t\t\t\t\t\t\t\t\t</span></div>
\t\t\t\t\t\t\t\t\t\t  ";
                        // line 237
                        if ((($__internal_compile_25 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 237)] ?? null) : null)) {
                            // line 238
                            echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                            echo (($__internal_compile_26 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 238)] ?? null) : null);
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 240
                        echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 242
                    echo "\t\t\t\t\t\t\t\t\t  ";
                }
                // line 243
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 243) == "time")) {
                    // line 244
                    echo "\t\t\t\t\t\t\t\t\t   ";
                    if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 244) == "one")) {
                        // line 245
                        echo "\t\t\t\t\t\t\t\t\t  <div ";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 245)) {
                            echo " required ";
                        }
                        echo " id=\"custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 245);
                        echo "\" class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 245)) {
                            echo " required ";
                        }
                        echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 245);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                        // line 246
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 246);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 246);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t  <div class=\"input-group time\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"custom_field[";
                        // line 248
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 248);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 248);
                        echo "]\" value=\"";
                        if ((($__internal_compile_27 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 248)] ?? null) : null)) {
                            echo (($__internal_compile_28 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 248)] ?? null) : null);
                        } else {
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 248);
                        }
                        echo "\" placeholder=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 248);
                        echo "\" data-date-format=\"HH:mm\" id=\"input-custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 248);
                        echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-calendar\"></i></button>
\t\t\t\t\t\t\t\t\t\t\t</span></div>
\t\t\t\t\t\t\t\t\t\t  ";
                        // line 252
                        if ((($__internal_compile_29 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 252)] ?? null) : null)) {
                            // line 253
                            echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                            echo (($__internal_compile_30 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 253)] ?? null) : null);
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 255
                        echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 257
                    echo "\t\t\t\t\t\t\t\t\t  ";
                }
                // line 258
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 258) == "time")) {
                    // line 259
                    echo "\t\t\t\t\t\t\t\t\t   ";
                    if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 259) == "one")) {
                        // line 260
                        echo "\t\t\t\t\t\t\t\t\t  <div ";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 260)) {
                            echo " required ";
                        }
                        echo " id=\"custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 260);
                        echo "\" class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 260)) {
                            echo " required ";
                        }
                        echo "  form-group custom-field\" data-sort=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 260);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-2 control-label\" for=\"input-custom-field";
                        // line 261
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 261);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 261);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t\t\t\t\t  <div class=\"input-group datetime\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"custom_field[";
                        // line 264
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 264);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 264);
                        echo "]\" value=\"";
                        if ((($__internal_compile_31 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 264)] ?? null) : null)) {
                            echo (($__internal_compile_32 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 264)] ?? null) : null);
                        } else {
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 264);
                        }
                        echo "\" placeholder=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 264);
                        echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-custom-field";
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 264);
                        echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-calendar\"></i></button>
\t\t\t\t\t\t\t\t\t\t\t</span></div>
\t\t\t\t\t\t\t\t\t\t  ";
                        // line 268
                        if ((($__internal_compile_33 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 268)] ?? null) : null)) {
                            // line 269
                            echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                            echo (($__internal_compile_34 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 269)] ?? null) : null);
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 270
                        echo " </div>
\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 273
                    echo "\t\t\t\t\t\t\t\t\t";
                }
                // line 274
                echo "\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 275
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"captapts\">
\t\t\t\t\t\t\t\t";
            // line 277
            echo ($context["captcha"] ?? null);
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
            // line 279
            if (($context["text_agree"] ?? null)) {
                // line 280
                echo "\t\t\t\t\t\t\t\t<div class=\"required\">
\t\t\t\t\t\t\t\t\t";
                // line 281
                echo ($context["text_agree"] ?? null);
                echo "
\t\t\t\t\t\t\t\t\t";
                // line 282
                if (($context["agree"] ?? null)) {
                    echo "\t\t\t  
\t\t\t\t\t\t\t\t\t<input id=\"pts_agree\" type=\"checkbox\" name=\"agree\" value=\"1\" checked=\"checked\" class=\"ptsc-sregister-marig\" />
\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 285
                    echo "\t\t\t\t\t\t\t\t\t<input  id=\"pts_agree\" type=\"checkbox\" name=\"agree\" value=\"1\" />\t\t
\t\t\t\t\t\t\t\t\t";
                }
                // line 286
                echo "\t
\t\t\t\t\t\t\t\t</div>\t\t\t  
\t\t\t\t\t\t\t\t";
            }
            // line 289
            echo "\t\t\t\t\t\t\t\t";
        }
        // line 290
        echo "\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!--end personal data-->
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<!--seller data-->
\t\t\t\t\t\t\t<div class=\"tab\">
\t\t\t\t\t\t\t\t<div class=\"pts-form-group required p-0\">\t\t\t\t
\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"store_name\">";
        // line 297
        echo ($context["entry_storename"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"store_name\" value=\"";
        // line 298
        echo ($context["store_name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_storename"] ?? null);
        echo "\" id=\"store_name\" class=\"pts-form-control\" />\t\t 
\t\t\t\t\t\t\t\t\t";
        // line 299
        if (($context["error_sellerstore"] ?? null)) {
            // line 300
            echo "\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["error_sellerstore"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t";
        }
        // line 302
        echo "\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        // line 304
        if (!twig_in_filter("store_phone", ($context["hide_fields"] ?? null))) {
            echo "\t\t
\t\t\t\t\t\t\t\t<div class=\"pts-form-group p-0\">
\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storephone\">";
            // line 306
            echo ($context["entry_storephone"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"store_phone\" value=\"";
            // line 307
            echo ($context["store_phone"] ?? null);
            echo "\" placeholder=\"";
            echo ($context["entry_storephone"] ?? null);
            echo "\" id=\"input-storephone\" class=\"pts-form-control\" />\t\t 
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        } else {
            // line 310
            echo "\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_phone\" value=\"\" >
\t\t\t\t\t\t\t\t";
        }
        // line 312
        echo "\t\t\t\t\t\t";
        if ((!twig_in_filter("store_logo", ($context["hide_fields"] ?? null)) || !twig_in_filter("store_banner", ($context["hide_fields"] ?? null)))) {
            // line 313
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t";
            // line 314
            if (!twig_in_filter("store_logo", ($context["hide_fields"] ?? null))) {
                // line 315
                echo "\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-6\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"store-logo\">";
                // line 316
                echo ($context["entry_storelogo"] ?? null);
                echo "</label>
\t\t\t\t\t\t\t\t\t\t<input class=\"filechangepts\" type=\"file\" name=\"store_logo\" id=\"store-logo\" value=\"\" accept=\"image/gif, image/jpeg, image/png\">\t
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
            } else {
                // line 321
                echo "\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_logo\" value=\"\" >
\t\t\t\t\t\t\t\t";
            }
            // line 322
            echo "\t
\t\t\t\t\t\t\t\t\t";
            // line 323
            if (!twig_in_filter("store_banner", ($context["hide_fields"] ?? null))) {
                // line 324
                echo "\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-6\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"store-banner\">";
                // line 325
                echo ($context["entry_storebanner"] ?? null);
                echo "</label>
\t\t\t\t\t\t\t\t\t\t<input class=\"filechangepts\" type=\"file\" name=\"store_banner\" id=\"store-banner\" value=\"\" accept=\"image/gif, image/jpeg, image/png\">\t\t\t
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t";
            } else {
                // line 329
                echo "\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_banner\" value=\"\" >
\t\t\t\t\t\t\t\t\t";
            }
            // line 330
            echo "\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        }
        // line 332
        echo "\t
\t\t\t\t\t\t\t\t";
        // line 333
        if (!twig_in_filter("store_address", ($context["hide_fields"] ?? null))) {
            // line 334
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-form-group p-0\">
\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeaddress\">";
            // line 335
            echo ($context["entry_storeaddress"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<textarea name=\"store_address\" class=\"pts-form-control\" rows=\"5\" placeholder=\"";
            // line 336
            echo ($context["entry_storeaddress"] ?? null);
            echo "\">";
            echo ($context["store_address"] ?? null);
            echo "</textarea>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        } else {
            // line 339
            echo "\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_address\" value=\"\" >
\t\t\t\t\t\t\t\t";
        }
        // line 340
        echo "\t
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t";
        // line 342
        if ((!twig_in_filter("store_country", ($context["hide_fields"] ?? null)) || !twig_in_filter("store_state", ($context["hide_fields"] ?? null)))) {
            // line 343
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t";
            // line 344
            if (!twig_in_filter("store_country", ($context["hide_fields"] ?? null))) {
                // line 345
                echo "\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-6\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storecountry\">";
                // line 346
                echo ($context["entry_storecountry"] ?? null);
                echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"pts-store-country\">
\t\t\t\t\t\t\t\t\t\t<select name=\"store_country\" id=\"input-storecountry\" onchange=\"country(this,'";
                // line 348
                echo ($context["store_state"] ?? null);
                echo "');\" class=\"pts-form-control\">
\t\t\t\t\t\t\t\t\t\t\t<option value=\"\">";
                // line 349
                echo ($context["text_select"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                // line 350
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
                    // line 351
                    echo "\t\t\t\t\t\t\t\t\t\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 351) == ($context["store_country"] ?? null))) {
                        // line 352
                        echo "\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 352);
                        echo "\" selected=\"selected\">";
                        echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 352);
                        echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                    } else {
                        // line 354
                        echo "\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 354);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 354);
                        echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 356
                    echo "\t\t\t\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 357
                echo "\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t";
            } else {
                // line 362
                echo "\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_country\" value=\"\" >
\t\t\t\t\t\t\t\t";
            }
            // line 363
            echo "\t
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t";
            // line 365
            if (!twig_in_filter("store_state", ($context["hide_fields"] ?? null))) {
                echo "\t
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-6\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"store-storestate\">";
                // line 367
                echo ($context["entry_storezone"] ?? null);
                echo "</label>\t
\t\t\t\t\t\t\t\t\t\t<div class=\"pts-store-state\">
\t\t\t\t\t\t\t\t\t\t<select name=\"store_state\" id=\"input-storestate\" class=\"pts-form-control\">
\t\t\t\t\t\t\t\t\t\t</select>\t\t             
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
            } else {
                // line 374
                echo "\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_state\" value=\"\" >
\t\t\t\t\t\t\t\t";
            }
            // line 375
            echo "\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        }
        // line 378
        echo "\t\t\t\t\t\t\t\t
\t\t\t\t\t\t";
        // line 379
        if ((!twig_in_filter("store_city", ($context["hide_fields"] ?? null)) || !twig_in_filter("store_zipcode", ($context["hide_fields"] ?? null)))) {
            // line 380
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t";
            // line 381
            if (!twig_in_filter("store_city", ($context["hide_fields"] ?? null))) {
                // line 382
                echo "\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-6\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-sellercity\">";
                // line 383
                echo ($context["entry_storecity"] ?? null);
                echo "</label>
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"store_city\" value=\"";
                // line 384
                echo ($context["store_city"] ?? null);
                echo "\" placeholder=\"";
                echo ($context["entry_storecity"] ?? null);
                echo "\" id=\"input-sellercity\" class=\"pts-form-control\" />\t 
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
            } else {
                // line 387
                echo "\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_city\" value=\"\" >
\t\t\t\t\t\t\t\t";
            }
            // line 388
            echo "\t
\t\t\t\t\t\t\t\t";
            // line 389
            if (!twig_in_filter("store_zipcode", ($context["hide_fields"] ?? null))) {
                // line 390
                echo "\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-6\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storepostcode\">";
                // line 391
                echo ($context["entry_storepostcode"] ?? null);
                echo "</label>
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"store_zipcode\" value=\"";
                // line 392
                echo ($context["store_zipcode"] ?? null);
                echo "\" placeholder=\"";
                echo ($context["entry_storepostcode"] ?? null);
                echo "\" id=\"input-storepostcode\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
            } else {
                // line 395
                echo "\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_zipcode\" value=\"\" >
\t\t\t\t\t\t\t\t";
            }
            // line 396
            echo "\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        }
        // line 398
        echo "\t
\t\t\t\t\t";
        // line 399
        if (!twig_in_filter("sellerarea", ($context["hide_fields"] ?? null))) {
            // line 400
            echo "\t\t\t\t\t\t\t<!-- seller area -->
\t\t\t\t\t\t\t<div class=\"pts-form-group pts-row\">
\t\t\t\t\t\t\t\t<label class=\"pts-col-sm-2 pts-control-label\" for=\"input-sellerarea\"><span data-toggle=\"tooltip\" title=\"";
            // line 402
            echo ($context["help_sellerarea"] ?? null);
            echo "\">";
            echo ($context["entry_sellerarea"] ?? null);
            echo "</span></label>
\t\t\t\t\t\t\t\t<div class=\"pts-col-sm-10\">
\t\t\t\t\t\t\t\t <select name=\"seller_area_selection_type\" class=\"pts-form-control\">\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t ";
            // line 406
            if (($context["seller_area_selection_type"] ?? null)) {
                // line 407
                echo "\t\t\t\t\t\t\t\t    <option value=\"0\">";
                echo ($context["text_all_sellerarea"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\" >";
                // line 408
                echo ($context["text_selected_sellerarea"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t ";
            } else {
                // line 410
                echo "\t\t\t\t\t\t\t\t    <option value=\"0\" selected=\"selected\">";
                echo ($context["text_all_sellerarea"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t<option value=\"1\">";
                // line 411
                echo ($context["text_selected_sellerarea"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t ";
            }
            // line 413
            echo "\t\t\t\t\t\t\t\t </select>
\t\t\t\t\t\t\t\t ";
            // line 414
            if (($context["seller_area_selection_type"] ?? null)) {
                // line 415
                echo "\t\t\t\t\t\t\t\t    <input type=\"text\" name=\"sellerarea\" value=\"\" placeholder=\"";
                echo ($context["entry_sellerarea"] ?? null);
                echo "\" id=\"input-sellerarea\" class=\"pts-form-control\"/>\t\t\t\t\t\t\t\t   
\t\t\t\t\t\t\t\t ";
            } else {
                // line 417
                echo "\t\t\t\t\t\t\t\t    <input type=\"text\" name=\"sellerarea\" value=\"\" disabled id=\"input-sellerarea\" class=\"pts-form-control\"/>
\t\t\t\t\t\t\t\t ";
            }
            // line 419
            echo "\t\t\t\t\t\t\t\t 
\t\t\t\t\t\t\t\t  <div id=\"seller-area\" class=\"well well-sm ptsc-product-heigoflow\"> 
\t\t\t\t\t\t\t\t  ";
            // line 421
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sellerareas"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["sellerarea"]) {
                // line 422
                echo "\t\t\t\t\t\t\t\t\t  <div id=\"seller-area";
                echo twig_get_attribute($this->env, $this->source, $context["sellerarea"], "area_id", [], "any", false, false, false, 422);
                echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                echo twig_get_attribute($this->env, $this->source, $context["sellerarea"], "name", [], "any", false, false, false, 422);
                echo "
\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"seller_area[]\" value=\"";
                // line 423
                echo twig_get_attribute($this->env, $this->source, $context["sellerarea"], "area_id", [], "any", false, false, false, 423);
                echo "\"/>
\t\t\t\t\t\t\t\t      </div>
\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sellerarea'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 425
            echo "</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t";
        } else {
            // line 429
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"seller_area[]\" value=\"\"/>
\t\t\t\t\t\t";
        }
        // line 430
        echo "\t
\t\t\t\t\t\t\t  <!-- End seller area -->
\t\t\t\t\t\t\t";
        // line 432
        if (!twig_in_filter("store_shipping_policy", ($context["hide_fields"] ?? null))) {
            // line 433
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeshipping\">";
            // line 435
            echo ($context["entry_storeshippingpolicy"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<textarea name=\"store_shipping_policy\" class=\"pts-form-control\" rows=\"5\" placeholder=\"";
            // line 436
            echo ($context["entry_storeshippingpolicy"] ?? null);
            echo "\" id=\"input-storeshipping\">";
            echo ($context["store_shipping_policy"] ?? null);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        } else {
            // line 440
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_shipping_policy\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 441
        echo "\t
\t\t\t\t\t\t\t";
        // line 442
        if (!twig_in_filter("store_return_policy", ($context["hide_fields"] ?? null))) {
            // line 443
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-return-policy\">";
            // line 445
            echo ($context["entry_storereturn"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<textarea name=\"store_return_policy\" class=\"pts-form-control\" rows=\"5\" placeholder=\"";
            // line 446
            echo ($context["entry_storereturn"] ?? null);
            echo "\" id=\"input-return-policy\">";
            echo ($context["store_return_policy"] ?? null);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        } else {
            // line 450
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_return_policy\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 451
        echo "\t
\t\t\t\t\t\t\t";
        // line 452
        if (!twig_in_filter("store_meta_keywords", ($context["hide_fields"] ?? null))) {
            // line 453
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeaddress\">";
            // line 455
            echo ($context["entry_storemetakeyword"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<textarea name=\"store_meta_keywords\" class=\"pts-form-control\" rows=\"5\" placeholder=\"";
            // line 456
            echo ($context["entry_storemetakeyword"] ?? null);
            echo "\" id=\"input-storeaddress\">";
            echo ($context["store_meta_keywords"] ?? null);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        } else {
            // line 460
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_meta_keywords\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 462
        echo "\t\t\t\t\t\t\t";
        if (!twig_in_filter("store_meta_description", ($context["hide_fields"] ?? null))) {
            // line 463
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-meta-description\">";
            // line 465
            echo ($context["entry_storemetadescription"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<textarea name=\"store_meta_description\" class=\"pts-form-control\" rows=\"5\" placeholder=\"";
            // line 466
            echo ($context["entry_storemetadescription"] ?? null);
            echo "\" id=\"input-meta-description\">";
            echo ($context["store_meta_description"] ?? null);
            echo "</textarea>\t\t\t\t\t
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        } else {
            // line 470
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_meta_description\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 472
        echo "\t\t\t\t\t\t\t";
        if (!twig_in_filter("store_seo", ($context["hide_fields"] ?? null))) {
            // line 473
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeseo\">";
            // line 475
            echo ($context["entry_storeseo"] ?? null);
            echo "</label>\t
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"store_seo\" value=\"";
            // line 476
            echo ($context["store_seo"] ?? null);
            echo "\" placeholder=\"";
            echo ($context["entry_storeseo"] ?? null);
            echo "\" id=\"input-storeseo\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t\t";
            // line 477
            if (($context["error_store_seo"] ?? null)) {
                // line 478
                echo "\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
                echo ($context["error_store_seo"] ?? null);
                echo "</div>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 480
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        } else {
            // line 483
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_seo\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 485
        echo "\t\t\t\t\t\t\t";
        if (!twig_in_filter("facebook_link", ($context["hide_fields"] ?? null))) {
            // line 486
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeseo\">";
            // line 488
            echo ($context["entry_facebook"] ?? null);
            echo "</label>\t
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"facebook_link\" value=\"\" placeholder=\"";
            // line 489
            echo ($context["entry_facebook"] ?? null);
            echo "\" id=\"input-storeseo\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        } else {
            // line 493
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"facebook_link\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 495
        echo "\t\t\t\t\t\t\t\t<!--<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeseo\">";
        // line 497
        echo ($context["entry_google"] ?? null);
        echo "</label>\t
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"google_link\" value=\"\" placeholder=\"";
        // line 498
        echo ($context["entry_google"] ?? null);
        echo "\" id=\"input-storeseo\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>-->
\t\t\t\t\t\t\t\t";
        // line 501
        if (!twig_in_filter("twitter_link", ($context["hide_fields"] ?? null))) {
            // line 502
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeseo\">";
            // line 504
            echo ($context["entry_twitter"] ?? null);
            echo "</label>\t
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"twitter_link\" value=\"\" placeholder=\"";
            // line 505
            echo ($context["entry_twitter"] ?? null);
            echo "\" id=\"input-storeseo\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        } else {
            // line 509
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"twitter_link\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 511
        echo "\t\t\t\t\t\t\t";
        if (!twig_in_filter("instagram_link", ($context["hide_fields"] ?? null))) {
            // line 512
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeseo\">";
            // line 514
            echo ($context["entry_instagram"] ?? null);
            echo "</label>\t
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"instagram_link\" value=\"\" placeholder=\"";
            // line 515
            echo ($context["entry_instagram"] ?? null);
            echo "\" id=\"input-storeseo\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        } else {
            // line 519
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"instagram_link\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 521
        echo "\t\t\t\t\t\t\t";
        if (!twig_in_filter("pinterest_link", ($context["hide_fields"] ?? null))) {
            // line 522
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeseo\">";
            // line 524
            echo ($context["entry_printerest"] ?? null);
            echo "</label>\t
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"pinterest_link\" value=\"\" placeholder=\"";
            // line 525
            echo ($context["entry_printerest"] ?? null);
            echo "\" id=\"input-storeseo\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t</div>\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        } else {
            // line 529
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"pinterest_link\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 531
        echo "\t\t\t\t\t\t\t";
        if (!twig_in_filter("wesbsite_link", ($context["hide_fields"] ?? null))) {
            // line 532
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">\t\t\t\t
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storeseo\">";
            // line 534
            echo ($context["entry_website"] ?? null);
            echo "</label>\t
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"wesbsite_link\" value=\"\" placeholder=\"";
            // line 535
            echo ($context["entry_website"] ?? null);
            echo "\" id=\"input-storeseo\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        } else {
            // line 539
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"wesbsite_link\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 541
        echo "\t\t\t\t\t\t";
        if (!twig_in_filter("whatsapp_link", ($context["hide_fields"] ?? null))) {
            // line 542
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">\t\t\t\t
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-whatsapp_link\">";
            // line 544
            echo ($context["entry_whatsapp_number"] ?? null);
            echo "</label>\t
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"whatsapp_link\" value=\"\" placeholder=\"";
            // line 545
            echo ($context["entry_whatsapp_number"] ?? null);
            echo "\" id=\"input-whatsapp_link\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        } else {
            // line 549
            echo "\t\t\t\t\t\t\t<input type=\"hidden\" name=\"whatsapp_link\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 551
        echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t<div class=\"pts-form-group\">
\t\t\t\t\t\t\t\t\t";
        // line 553
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["custom_fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_field"]) {
            // line 554
            echo "\t\t\t\t\t\t\t\t\t ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 554) == "select")) {
                // line 555
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 555) == "two")) {
                    // line 556
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 556)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 556);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 556)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 557
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 557);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 557);
                    echo "</label>
\t\t\t\t\t\t\t\t\t 
\t\t\t\t\t\t\t\t\t\t  <select name=\"custom_field[";
                    // line 559
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 559);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 559);
                    echo "]\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 559);
                    echo "\" class=\"pts-form-control\">
\t\t\t\t\t\t\t\t\t\t\t<option value=\"\">";
                    // line 560
                    echo ($context["text_select"] ?? null);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                    // line 561
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 561));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 562
                        echo "\t\t\t\t\t\t\t\t\t\t\t";
                        if (((($__internal_compile_35 = (($__internal_compile_36 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36[twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 562)] ?? null) : null)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 562)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 562) == (($__internal_compile_37 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 562)] ?? null) : null)))) {
                            // line 563
                            echo "\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 563);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 563);
                            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 565
                            echo "\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 565);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 565);
                            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 567
                        echo "\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    echo " 
\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 569
                    if ((($__internal_compile_38 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 569)] ?? null) : null)) {
                        // line 570
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_39 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 570)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 572
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 574
                echo "\t\t\t\t\t\t\t\t\t";
            }
            // line 575
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 575) == "radio")) {
                // line 576
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 576) == "two")) {
                    // line 577
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 577)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 577);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 577)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0 ptsradioinp\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\">";
                    // line 578
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 578);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <div> ";
                    // line 579
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 579));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 580
                        echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"radio\">";
                        if (((($__internal_compile_40 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 580)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 580) == (($__internal_compile_41 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 580)] ?? null) : null)))) {
                            // line 581
                            echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"custom_field[";
                            // line 582
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 582);
                            echo "][";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 582);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 582);
                            echo "\" checked=\"checked\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 583
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 583);
                            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                        } else {
                            // line 585
                            echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"custom_field[";
                            // line 586
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 586);
                            echo "][";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 586);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 586);
                            echo "\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 587
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 587);
                            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 588
                        echo " </div>
\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 589
                    echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 590
                    if ((($__internal_compile_42 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 590)] ?? null) : null)) {
                        // line 591
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_43 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 591)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 593
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 595
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 596
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 596) == "checkbox")) {
                // line 597
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 597) == "two")) {
                    // line 598
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 598)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 598);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 598)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 598);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\">";
                    // line 599
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 599);
                    echo "</label>
\t\t\t\t\t\t\t\t   
\t\t\t\t\t\t\t\t\t\t  <div> ";
                    // line 601
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 601));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 602
                        echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">";
                        if (((($__internal_compile_44 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 602)] ?? null) : null) && twig_in_filter(twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 602), (($__internal_compile_45 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 602)] ?? null) : null)))) {
                            // line 603
                            echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"custom_field[";
                            // line 604
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 604);
                            echo "][";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 604);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 604);
                            echo "\" checked=\"checked\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 605
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 605);
                            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                        } else {
                            // line 607
                            echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"custom_field[";
                            // line 608
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 608);
                            echo "][";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 608);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 608);
                            echo "\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 609
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 609);
                            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 610
                        echo " </div>
\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 611
                    echo " </div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 612
                    if ((($__internal_compile_46 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_46) || $__internal_compile_46 instanceof ArrayAccess ? ($__internal_compile_46[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 612)] ?? null) : null)) {
                        // line 613
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_47 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_47) || $__internal_compile_47 instanceof ArrayAccess ? ($__internal_compile_47[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 613)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 615
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 617
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 618
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 618) == "text")) {
                // line 619
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 619) == "two")) {
                    // line 620
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 620)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 620);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 620)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 620);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 621
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 621);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 621);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <input type=\"text\" name=\"custom_field[";
                    // line 622
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 622);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 622);
                    echo "]\" value=\"";
                    if ((($__internal_compile_48 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_48) || $__internal_compile_48 instanceof ArrayAccess ? ($__internal_compile_48[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 622)] ?? null) : null)) {
                        echo (($__internal_compile_49 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_49) || $__internal_compile_49 instanceof ArrayAccess ? ($__internal_compile_49[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 622)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 622);
                    }
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 622);
                    echo "\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 622);
                    echo "\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 623
                    if ((($__internal_compile_50 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_50) || $__internal_compile_50 instanceof ArrayAccess ? ($__internal_compile_50[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 623)] ?? null) : null)) {
                        // line 624
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_51 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_51) || $__internal_compile_51 instanceof ArrayAccess ? ($__internal_compile_51[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 624)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 626
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 628
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 629
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 629) == "textarea")) {
                // line 630
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 630) == "two")) {
                    // line 631
                    echo "\t\t\t\t\t\t\t\t\t   <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 631)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 631);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 631)) {
                        echo " required ";
                    }
                    echo "  pts-form-group custom-field\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 631);
                    echo "\">
\t\t\t\t\t\t\t\t\t  <label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 632
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 632);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 632);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t<textarea name=\"custom_field[";
                    // line 633
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 633);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 633);
                    echo "]\" class=\"pts-form-control\" rows=\"5\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 633);
                    echo "\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 633);
                    echo "\">";
                    echo ($context["store_address"] ?? null);
                    if ((($__internal_compile_52 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_52) || $__internal_compile_52 instanceof ArrayAccess ? ($__internal_compile_52[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 633)] ?? null) : null)) {
                        echo (($__internal_compile_53 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_53) || $__internal_compile_53 instanceof ArrayAccess ? ($__internal_compile_53[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 633)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 633);
                    }
                    echo "</textarea>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 636
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 637
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 637) == "file")) {
                // line 638
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 638) == "two")) {
                    // line 639
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 639)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 639);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 639)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 639);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\">";
                    // line 640
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 640);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <button type=\"button\" id=\"button-custom-field";
                    // line 641
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 641);
                    echo "\" data-loading-text=\"";
                    echo ($context["text_loading"] ?? null);
                    echo "\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-upload\"></i> ";
                    echo ($context["button_upload"] ?? null);
                    echo "</button>
\t\t\t\t\t\t\t\t\t\t  <input type=\"hidden\" name=\"custom_field[";
                    // line 642
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 642);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 642);
                    echo "]\" value=\"";
                    if ((($__internal_compile_54 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_54) || $__internal_compile_54 instanceof ArrayAccess ? ($__internal_compile_54[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 642)] ?? null) : null)) {
                        echo "  ";
                        echo (($__internal_compile_55 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_55) || $__internal_compile_55 instanceof ArrayAccess ? ($__internal_compile_55[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 642)] ?? null) : null);
                        echo " ";
                    }
                    echo "\" />
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 643
                    if ((($__internal_compile_56 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_56) || $__internal_compile_56 instanceof ArrayAccess ? ($__internal_compile_56[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 643)] ?? null) : null)) {
                        // line 644
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_57 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_57) || $__internal_compile_57 instanceof ArrayAccess ? ($__internal_compile_57[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 644)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 646
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 648
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 649
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 649) == "date")) {
                // line 650
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 650) == "two")) {
                    // line 651
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 651)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 651);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 651)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 651);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 652
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 652);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 652);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <div class=\"input-group date\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"custom_field[";
                    // line 654
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 654);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 654);
                    echo "]\" value=\"";
                    if ((($__internal_compile_58 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_58) || $__internal_compile_58 instanceof ArrayAccess ? ($__internal_compile_58[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 654)] ?? null) : null)) {
                        echo (($__internal_compile_59 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_59) || $__internal_compile_59 instanceof ArrayAccess ? ($__internal_compile_59[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 654)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 654);
                    }
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 654);
                    echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 654);
                    echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-calendar\"></i></button>
\t\t\t\t\t\t\t\t\t\t\t</span></div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 658
                    if ((($__internal_compile_60 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_60) || $__internal_compile_60 instanceof ArrayAccess ? ($__internal_compile_60[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 658)] ?? null) : null)) {
                        // line 659
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_61 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_61) || $__internal_compile_61 instanceof ArrayAccess ? ($__internal_compile_61[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 659)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 661
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 663
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 664
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 664) == "time")) {
                // line 665
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 665) == "two")) {
                    // line 666
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 666)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 666);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 666)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 666);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 667
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 667);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 667);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <div class=\"input-group time\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"custom_field[";
                    // line 669
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 669);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 669);
                    echo "]\" value=\"";
                    if ((($__internal_compile_62 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_62) || $__internal_compile_62 instanceof ArrayAccess ? ($__internal_compile_62[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 669)] ?? null) : null)) {
                        echo (($__internal_compile_63 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_63) || $__internal_compile_63 instanceof ArrayAccess ? ($__internal_compile_63[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 669)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 669);
                    }
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 669);
                    echo "\" data-date-format=\"HH:mm\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 669);
                    echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-calendar\"></i></button>
\t\t\t\t\t\t\t\t\t\t\t</span></div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 673
                    if ((($__internal_compile_64 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_64) || $__internal_compile_64 instanceof ArrayAccess ? ($__internal_compile_64[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 673)] ?? null) : null)) {
                        // line 674
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_65 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_65) || $__internal_compile_65 instanceof ArrayAccess ? ($__internal_compile_65[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 674)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 676
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 678
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 679
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 679) == "time")) {
                // line 680
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 680) == "two")) {
                    // line 681
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 681)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 681);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 681)) {
                        echo " required ";
                    }
                    echo "  form-group custom-field\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 681);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-2 control-label\" for=\"input-custom-field";
                    // line 682
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 682);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 682);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t\t\t\t\t  <div class=\"input-group datetime\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"custom_field[";
                    // line 685
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 685);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 685);
                    echo "]\" value=\"";
                    if ((($__internal_compile_66 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_66) || $__internal_compile_66 instanceof ArrayAccess ? ($__internal_compile_66[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 685)] ?? null) : null)) {
                        echo (($__internal_compile_67 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_67) || $__internal_compile_67 instanceof ArrayAccess ? ($__internal_compile_67[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 685)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 685);
                    }
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 685);
                    echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 685);
                    echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-calendar\"></i></button>
\t\t\t\t\t\t\t\t\t\t\t</span></div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 689
                    if ((($__internal_compile_68 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_68) || $__internal_compile_68 instanceof ArrayAccess ? ($__internal_compile_68[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 689)] ?? null) : null)) {
                        // line 690
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_69 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_69) || $__internal_compile_69 instanceof ArrayAccess ? ($__internal_compile_69[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 690)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 691
                    echo " </div>
\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 694
                echo "\t\t\t\t\t\t\t\t\t";
            }
            // line 695
            echo "\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 696
        echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        // line 698
        if (($context["module_purpletree_multivendor_allow_live_chat"] ?? null)) {
            // line 699
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-6\">\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-live-chat\">";
            // line 701
            echo ($context["entry_allow_live_chat"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t\t<select name=\"store_live_chat_enable\" id=\"input-live-chat\" class=\"pts-form-control\">\t\t\t  
\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" ";
            // line 703
            if (($context["store_live_chat_enable"] ?? null)) {
                echo " selected=\"selected\" ";
            }
            echo ">";
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" ";
            // line 704
            if ((($context["store_live_chat_enable"] ?? null) == 0)) {
                echo " selected=\"selected\" ";
            }
            echo ">";
            echo ($context["text_no"] ?? null);
            echo "</option>\t\t\t 
\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-6\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-live_chat_code\">";
            // line 708
            echo ($context["entry_live_chat_code"] ?? null);
            echo "</label>\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<textarea id=\"input-live_chat_code\" name=\"store_live_chat_code\" class=\"pts-form-control\" rows=\"5\">";
            // line 709
            echo ($context["store_live_chat_code"] ?? null);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        }
        // line 712
        echo "\t\t\t\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!--end store data-->
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<!--payment data-->
\t\t\t\t\t\t\t<div class=\"tab\">
\t\t\t\t\t\t\t";
        // line 719
        if (!twig_in_filter("store_bank_details", ($context["hide_fields"] ?? null))) {
            // line 720
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-form-group p-0\">
\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storebankdetail\">";
            // line 721
            echo ($context["entry_storebankdetail"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t<textarea name=\"store_bank_details\" class=\"pts-form-control\" rows=\"5\" placeholder=\"";
            // line 722
            echo ($context["entry_storebankdetail1"] ?? null);
            echo "\">";
            echo ($context["store_bank_details"] ?? null);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        } else {
            // line 726
            echo "\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_bank_details\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 727
        echo "\t
\t\t\t\t\t\t\t";
        // line 728
        if (!twig_in_filter("store_tin", ($context["hide_fields"] ?? null))) {
            // line 729
            echo "\t\t\t\t\t\t\t\t<div class=\"pts-form-group p-0\">\t\t\t\t\t
\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-storetin\">";
            // line 730
            echo ($context["entry_storetin"] ?? null);
            echo "</label> <input type=\"text\" name=\"store_tin\" value=\"";
            echo ($context["store_tin"] ?? null);
            echo "\" placeholder=\"";
            echo ($context["entry_storetin1"] ?? null);
            echo "\" id=\"input-storetin\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t";
        } else {
            // line 734
            echo "\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"store_tin\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 735
        echo "\t\t
\t\t\t\t\t\t\t";
        // line 736
        if (!twig_in_filter("seller_paypal_id", ($context["hide_fields"] ?? null))) {
            echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t\t<!-- paypal -->
\t\t\t\t\t\t\t\t\t<div class=\"pts-form-group pts-col-md-12\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-seller-paypal-id\">";
            // line 740
            echo ($context["entry_seller_paypal_id"] ?? null);
            echo "
\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" id=\"input-seller-paypal-id\" name=\"seller_paypal_id\" class=\"pts-form-control email\" value=\"";
            // line 742
            echo ($context["seller_paypal_id"] ?? null);
            echo "\" />
\t\t\t\t\t\t\t\t\t\t";
            // line 743
            if (($context["error_seller_paypal_id"] ?? null)) {
                // line 744
                echo "\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
                echo ($context["error_seller_paypal_id"] ?? null);
                echo "</div>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 746
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- End paypal -->
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
        } else {
            // line 750
            echo "\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"seller_paypal_id\" value=\"\"/>
\t\t\t\t\t\t\t";
        }
        // line 751
        echo "\t
\t\t\t\t\t\t\t<div class=\"pts-row\">
\t\t\t\t\t\t\t\t<div class=\"pts-form-group\">
\t\t\t\t\t\t\t\t\t";
        // line 754
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["custom_fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_field"]) {
            // line 755
            echo "\t\t\t\t\t\t\t\t\t ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 755) == "select")) {
                // line 756
                echo "\t\t\t\t\t\t\t\t\t  ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 756) == "three")) {
                    // line 757
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 757)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 757);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 757)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 758
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 758);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 758);
                    echo "</label>
\t\t\t\t\t\t\t\t\t 
\t\t\t\t\t\t\t\t\t\t  <select name=\"custom_field[";
                    // line 760
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 760);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 760);
                    echo "]\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 760);
                    echo "\" class=\"pts-form-control\">
\t\t\t\t\t\t\t\t\t\t\t<option value=\"\">";
                    // line 761
                    echo ($context["text_select"] ?? null);
                    echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                    // line 762
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 762));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 763
                        echo "\t\t\t\t\t\t\t\t\t\t\t";
                        if (((($__internal_compile_70 = (($__internal_compile_71 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_71) || $__internal_compile_71 instanceof ArrayAccess ? ($__internal_compile_71[twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 763)] ?? null) : null)) && is_array($__internal_compile_70) || $__internal_compile_70 instanceof ArrayAccess ? ($__internal_compile_70[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 763)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 763) == (($__internal_compile_72 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_72) || $__internal_compile_72 instanceof ArrayAccess ? ($__internal_compile_72[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 763)] ?? null) : null)))) {
                            // line 764
                            echo "\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 764);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 764);
                            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 766
                            echo "\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 766);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 766);
                            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 768
                        echo "\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    echo " 
\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 770
                    if ((($__internal_compile_73 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_73) || $__internal_compile_73 instanceof ArrayAccess ? ($__internal_compile_73[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 770)] ?? null) : null)) {
                        // line 771
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_74 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_74) || $__internal_compile_74 instanceof ArrayAccess ? ($__internal_compile_74[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 771)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 773
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 775
                echo "\t\t\t\t\t\t\t\t\t";
            }
            // line 776
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 776) == "radio")) {
                // line 777
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 777) == "three")) {
                    // line 778
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 778)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 778);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 778)) {
                        echo " required ";
                    }
                    echo "  ptsradioinp pts-form-group pts-col-md-12 p-0\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\">";
                    // line 779
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 779);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <div> ";
                    // line 780
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 780));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 781
                        echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"radio\">";
                        if (((($__internal_compile_75 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_75) || $__internal_compile_75 instanceof ArrayAccess ? ($__internal_compile_75[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 781)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 781) == (($__internal_compile_76 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_76) || $__internal_compile_76 instanceof ArrayAccess ? ($__internal_compile_76[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 781)] ?? null) : null)))) {
                            // line 782
                            echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"custom_field[";
                            // line 783
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 783);
                            echo "][";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 783);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 783);
                            echo "\" checked=\"checked\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 784
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 784);
                            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                        } else {
                            // line 786
                            echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"custom_field[";
                            // line 787
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 787);
                            echo "][";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 787);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 787);
                            echo "\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 788
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 788);
                            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 789
                        echo " </div>
\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 790
                    echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 791
                    if ((($__internal_compile_77 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_77) || $__internal_compile_77 instanceof ArrayAccess ? ($__internal_compile_77[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 791)] ?? null) : null)) {
                        // line 792
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_78 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_78) || $__internal_compile_78 instanceof ArrayAccess ? ($__internal_compile_78[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 792)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 794
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 796
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 797
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 797) == "checkbox")) {
                // line 798
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 798) == "three")) {
                    // line 799
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 799)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 799);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 799)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 799);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\">";
                    // line 800
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 800);
                    echo "</label>
\t\t\t\t\t\t\t\t   
\t\t\t\t\t\t\t\t\t\t  <div> ";
                    // line 802
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 802));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 803
                        echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox\">";
                        if (((($__internal_compile_79 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_79) || $__internal_compile_79 instanceof ArrayAccess ? ($__internal_compile_79[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 803)] ?? null) : null) && twig_in_filter(twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 803), (($__internal_compile_80 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_80) || $__internal_compile_80 instanceof ArrayAccess ? ($__internal_compile_80[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 803)] ?? null) : null)))) {
                            // line 804
                            echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"custom_field[";
                            // line 805
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 805);
                            echo "][";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 805);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 805);
                            echo "\" checked=\"checked\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 806
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 806);
                            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                        } else {
                            // line 808
                            echo "\t\t\t\t\t\t\t\t\t\t\t  <label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"custom_field[";
                            // line 809
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 809);
                            echo "][";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 809);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 809);
                            echo "\" />
\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 810
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 810);
                            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t  ";
                        }
                        // line 811
                        echo " </div>
\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 812
                    echo " </div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 813
                    if ((($__internal_compile_81 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_81) || $__internal_compile_81 instanceof ArrayAccess ? ($__internal_compile_81[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 813)] ?? null) : null)) {
                        // line 814
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_82 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_82) || $__internal_compile_82 instanceof ArrayAccess ? ($__internal_compile_82[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 814)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 816
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 818
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 819
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 819) == "text")) {
                // line 820
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 820) == "three")) {
                    // line 821
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 821)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 821);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 821)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 821);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 822
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 822);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 822);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <input type=\"text\" name=\"custom_field[";
                    // line 823
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 823);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 823);
                    echo "]\" value=\"";
                    if ((($__internal_compile_83 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_83) || $__internal_compile_83 instanceof ArrayAccess ? ($__internal_compile_83[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 823)] ?? null) : null)) {
                        echo (($__internal_compile_84 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_84) || $__internal_compile_84 instanceof ArrayAccess ? ($__internal_compile_84[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 823)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 823);
                    }
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 823);
                    echo "\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 823);
                    echo "\" class=\"pts-form-control\" />
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 824
                    if ((($__internal_compile_85 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_85) || $__internal_compile_85 instanceof ArrayAccess ? ($__internal_compile_85[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 824)] ?? null) : null)) {
                        // line 825
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_86 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_86) || $__internal_compile_86 instanceof ArrayAccess ? ($__internal_compile_86[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 825)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 827
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 829
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 830
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 830) == "textarea")) {
                // line 831
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 831) == "three")) {
                    // line 832
                    echo "\t\t\t\t\t\t\t\t\t   <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 832)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 832);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 832)) {
                        echo " required ";
                    }
                    echo "  pts-form-group custom-field\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 832);
                    echo "\">
\t\t\t\t\t\t\t\t\t  <label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 833
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 833);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 833);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t<textarea name=\"custom_field[";
                    // line 834
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 834);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 834);
                    echo "]\" class=\"pts-form-control\" rows=\"5\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 834);
                    echo "\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 834);
                    echo "\">";
                    echo ($context["store_address"] ?? null);
                    if ((($__internal_compile_87 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_87) || $__internal_compile_87 instanceof ArrayAccess ? ($__internal_compile_87[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 834)] ?? null) : null)) {
                        echo (($__internal_compile_88 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_88) || $__internal_compile_88 instanceof ArrayAccess ? ($__internal_compile_88[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 834)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 834);
                    }
                    echo "</textarea>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 837
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 838
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 838) == "file")) {
                // line 839
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 839) == "three")) {
                    // line 840
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 840)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 840);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 840)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 840);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\">";
                    // line 841
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 841);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <button type=\"button\" id=\"button-custom-field";
                    // line 842
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 842);
                    echo "\" data-loading-text=\"";
                    echo ($context["text_loading"] ?? null);
                    echo "\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-upload\"></i> ";
                    echo ($context["button_upload"] ?? null);
                    echo "</button>
\t\t\t\t\t\t\t\t\t\t  <input type=\"hidden\" name=\"custom_field[";
                    // line 843
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 843);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 843);
                    echo "]\" value=\"";
                    if ((($__internal_compile_89 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_89) || $__internal_compile_89 instanceof ArrayAccess ? ($__internal_compile_89[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 843)] ?? null) : null)) {
                        echo "  ";
                        echo (($__internal_compile_90 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_90) || $__internal_compile_90 instanceof ArrayAccess ? ($__internal_compile_90[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 843)] ?? null) : null);
                        echo " ";
                    }
                    echo "\" />
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 844
                    if ((($__internal_compile_91 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_91) || $__internal_compile_91 instanceof ArrayAccess ? ($__internal_compile_91[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 844)] ?? null) : null)) {
                        // line 845
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_92 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_92) || $__internal_compile_92 instanceof ArrayAccess ? ($__internal_compile_92[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 845)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 847
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 849
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 850
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 850) == "date")) {
                // line 851
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 851) == "three")) {
                    // line 852
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 852)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 852);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 852)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 852);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 853
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 853);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 853);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <div class=\"input-group date\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"custom_field[";
                    // line 855
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 855);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 855);
                    echo "]\" value=\"";
                    if ((($__internal_compile_93 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_93) || $__internal_compile_93 instanceof ArrayAccess ? ($__internal_compile_93[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 855)] ?? null) : null)) {
                        echo (($__internal_compile_94 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_94) || $__internal_compile_94 instanceof ArrayAccess ? ($__internal_compile_94[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 855)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 855);
                    }
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 855);
                    echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 855);
                    echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-calendar\"></i></button>
\t\t\t\t\t\t\t\t\t\t\t</span></div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 859
                    if ((($__internal_compile_95 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_95) || $__internal_compile_95 instanceof ArrayAccess ? ($__internal_compile_95[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 859)] ?? null) : null)) {
                        // line 860
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_96 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_96) || $__internal_compile_96 instanceof ArrayAccess ? ($__internal_compile_96[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 860)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 862
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 864
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 865
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 865) == "time")) {
                // line 866
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 866) == "three")) {
                    // line 867
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 867)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 867);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 867)) {
                        echo " required ";
                    }
                    echo "  pts-form-group pts-col-md-12 p-0\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 867);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"pts-control-label\" for=\"input-custom-field";
                    // line 868
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 868);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 868);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t  <div class=\"input-group time\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"custom_field[";
                    // line 870
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 870);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 870);
                    echo "]\" value=\"";
                    if ((($__internal_compile_97 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_97) || $__internal_compile_97 instanceof ArrayAccess ? ($__internal_compile_97[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 870)] ?? null) : null)) {
                        echo (($__internal_compile_98 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_98) || $__internal_compile_98 instanceof ArrayAccess ? ($__internal_compile_98[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 870)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 870);
                    }
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 870);
                    echo "\" data-date-format=\"HH:mm\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 870);
                    echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-calendar\"></i></button>
\t\t\t\t\t\t\t\t\t\t\t</span></div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 874
                    if ((($__internal_compile_99 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_99) || $__internal_compile_99 instanceof ArrayAccess ? ($__internal_compile_99[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 874)] ?? null) : null)) {
                        // line 875
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_100 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_100) || $__internal_compile_100 instanceof ArrayAccess ? ($__internal_compile_100[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 875)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 877
                    echo "\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 879
                echo "\t\t\t\t\t\t\t\t\t  ";
            }
            // line 880
            echo "\t\t\t\t\t\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 880) == "time")) {
                // line 881
                echo "\t\t\t\t\t\t\t\t\t   ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "step_location", [], "any", false, false, false, 881) == "three")) {
                    // line 882
                    echo "\t\t\t\t\t\t\t\t\t  <div ";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 882)) {
                        echo " required ";
                    }
                    echo " id=\"custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 882);
                    echo "\" class=\"";
                    if (twig_get_attribute($this->env, $this->source, $context["custom_field"], "required", [], "any", false, false, false, 882)) {
                        echo " required ";
                    }
                    echo "  form-group custom-field\" data-sort=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 882);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<label class=\"col-sm-2 control-label\" for=\"input-custom-field";
                    // line 883
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 883);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 883);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t\t\t\t\t\t  <div class=\"input-group datetime\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"custom_field[";
                    // line 886
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 886);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 886);
                    echo "]\" value=\"";
                    if ((($__internal_compile_101 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_101) || $__internal_compile_101 instanceof ArrayAccess ? ($__internal_compile_101[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 886)] ?? null) : null)) {
                        echo (($__internal_compile_102 = ($context["register_custom_field"] ?? null)) && is_array($__internal_compile_102) || $__internal_compile_102 instanceof ArrayAccess ? ($__internal_compile_102[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 886)] ?? null) : null);
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 886);
                    }
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 886);
                    echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 886);
                    echo "\" class=\"form-control\" />
\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"pts-btn pts-btn-sm pts-btn-default\"><i class=\"fa fa-calendar\"></i></button>
\t\t\t\t\t\t\t\t\t\t\t</span></div>
\t\t\t\t\t\t\t\t\t\t  ";
                    // line 890
                    if ((($__internal_compile_103 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_103) || $__internal_compile_103 instanceof ArrayAccess ? ($__internal_compile_103[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 890)] ?? null) : null)) {
                        // line 891
                        echo "\t\t\t\t\t\t\t\t\t\t  <div class=\"text-danger\">";
                        echo (($__internal_compile_104 = ($context["error_custom_field"] ?? null)) && is_array($__internal_compile_104) || $__internal_compile_104 instanceof ArrayAccess ? ($__internal_compile_104[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 891)] ?? null) : null);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t  ";
                    }
                    // line 892
                    echo " </div>
\t\t\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t\t\t\t  ";
                }
                // line 895
                echo "\t\t\t\t\t\t\t\t\t";
            }
            // line 896
            echo "\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 897
        echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!--end payment data-->\t\t\t
\t\t\t\t\t\t\t<div class=\"pts-form-group pts-text-right\">
\t\t\t\t\t\t\t\t<div class=\"ptsc-sregister-overflow\">
\t\t\t\t\t\t\t\t\t<div class=\"ptsc-subpl-florig\">
\t\t\t\t\t\t\t\t\t\t<button type=\"button\" id=\"prevBtn1\" class=\"pts-btn pts-btn-sm pts-btn-default\" onclick=\"nextPrev(-1)\">";
        // line 904
        echo ($context["btn_prev"] ?? null);
        echo "</button>
\t\t\t\t\t\t\t\t\t\t<button type=\"button\" id=\"nextBtn1\" class=\"pts-btn pts-btn-sm pts-btn-primary\" onclick=\"nextPrev(1)\">";
        // line 905
        echo ($context["btn_next"] ?? null);
        echo "</button>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>\t\t\t\t
\t\t\t\t\t\t\t<!-- Circles which indicates the steps of the form: -->
\t\t\t\t\t\t</div>
\t\t\t\t<div>
\t\t\t\t\t<span class=\"step\"></span>
\t\t\t\t\t<span class=\"step\"></span>
\t\t\t\t\t<span class=\"step\"></span>
\t\t\t\t\t<span class=\"step\"></span>
\t\t\t\t</div>
\t\t\t</form>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t</div>
</div>
<!--seller registration form-->
<link href=\"extension/purpletree_multivendor/catalog/view/assets/css/commonstylesheet.css\" type=\"text/css\" rel=\"stylesheet\" />
<script type=\"text/javascript\">

\t";
        // line 926
        if ((($context["loggedcus"] ?? null) == "")) {
            // line 927
            echo "\tvar currentTabpts = 0; // Current tab is set to be the first tab (0)
\t\tshowTabpts(currentTabpts);
\t";
        } else {
            // line 930
            echo "\tvar currentTabpts = 1; // Current tab is set to be the first tab (0)
\t\tshowTabpts(currentTabpts);
\t";
        }
        // line 933
        echo " // Display the crurrent tab
\t
\tfunction showTabpts(n) {
\t\t// This function will display the specified tab of the form...
\t\tvar x = document.getElementsByClassName(\"tab\");
\t\tx[n].style.display = \"block\";
\t\t//... and fix the Previous/Next buttons:
\t\tif (n == 0) {
\t\t\t\$('.step.step-one').addClass('finish');
\t\t\t\$('.step.step-two').removeClass('finish');
\t\t\t\$('.step.step-three').removeClass('finish');
\t\t\tdocument.getElementById(\"prevBtn\").style.display = \"none\";
\t\t\tdocument.getElementById(\"prevBtn1\").style.display = \"none\";
\t\t\t} else {
\t\t\t";
        // line 947
        if ((($context["loggedcus"] ?? null) == "")) {
            // line 948
            echo "\t\t\tdocument.getElementById(\"prevBtn\").style.display = \"inline\";
\t\t\tdocument.getElementById(\"prevBtn1\").style.display = \"inline\";
\t\t\t";
        } else {
            // line 951
            echo "\t\t\tif (n == 1) {
\t\t\t\tdocument.getElementById(\"prevBtn\").style.display = \"none\";
\t\t\t\tdocument.getElementById(\"prevBtn1\").style.display = \"none\";
\t\t\t\t} else {
\t\t\t\tdocument.getElementById(\"prevBtn\").style.display = \"inline\";
\t\t\t\tdocument.getElementById(\"prevBtn1\").style.display = \"inline\";
\t\t\t}
\t\t\t";
        }
        // line 959
        echo "\t\t\t
\t\t}
\t\tif (n == 1) {
\t\t\t\$('.step.step-one').addClass('finish');
\t\t\t\$('.step.step-two').addClass('finish');
\t\t\t\$('.step.step-three').removeClass('finish');
\t\t}
\t\tif (n == (x.length - 1)) {
\t\t\tdocument.getElementById(\"nextBtn\").innerHTML = \"";
        // line 967
        echo ($context["btn_submit1"] ?? null);
        echo "\";
\t\t\tdocument.getElementById(\"nextBtn1\").innerHTML = \"";
        // line 968
        echo ($context["btn_submit1"] ?? null);
        echo "\";
\t\t\t} else {
\t\t\tdocument.getElementById(\"nextBtn\").innerHTML = \"";
        // line 970
        echo ($context["btn_next"] ?? null);
        echo "\";
\t\t\tdocument.getElementById(\"nextBtn1\").innerHTML = \"";
        // line 971
        echo ($context["btn_next"] ?? null);
        echo "\";
\t\t}
\t\t//... and run a function that will display the correct step indicator:
\t\tfixStepIndicator(n)
\t}
\t
\tfunction nextPrev(n) {
\t\t// This function will figure out which tab to display
\t\tvar x = document.getElementsByClassName(\"tab\");
\t\t// Exit the function if any field in the current tab is invalid:
\t\tif (n == 1 && !validateForm(currentTabpts)) return false;
\t\t
\t\t// Hide the current tab:
\t\tx[currentTabpts].style.display = \"none\";
\t\t// Increase or decrease the current tab by 1:
\t\tcurrentTabpts = currentTabpts + n;
\t\t// if you have reached the end of the form...
\t\tif (currentTabpts >= x.length) {
\t\t\t// ... the form gets submitted:
\t\t\tdocument.getElementById(\"regForm\").submit();
\t\t\treturn false;
\t\t}
\t\t// Otherwise, display the correct tab:
\t\tshowTabpts(currentTabpts);
\t}
\t
\tfunction validateForm(currentTabpts) {
\t\t\t
\t\t// This function deals with validation of the form fields
\t\t//var valid = true;
\t\t//x = document.getElementsByClassName(\"tab\");
\t\t// y = x[currentTabpts].getElementsByTagName(\"input\");
\t\t
\t\tvalid = false;
\t\t// Wait for the DOM to be ready
\t\t// Initialize form validation on the registration form.
\t\t// It has the name attribute \"registration\"
\t\t// alert('in');
\t\t\$(\"#regForm\").validate({
\t\t\t// Specify validation rules
\t\t\trules: {
\t\t\t\t// The key name on the left side is the name attribute
\t\t\t\t// of an input field. Validation rules are defined
\t\t\t\t// on the right side
\t\t
\t\t\t\tfirstname: \"required\",
\t\t\t\tlastname: \"required\",
\t\t\t\tstore_name: \"required\",\t\t
\t\t\t\temail: {
\t\t\t\t\trequired: true,
\t\t\t\t\t// Specify that email should be validated
\t\t\t\t\t// by the built-in \"email\" rule
\t\t\t\t\temail: true
\t\t\t\t},
\t\t\t\tpassword: {
\t\t\t\t\trequired: true,
\t\t\t\t\tminlength: 5
\t\t\t\t},
\t\t\t\tconfirm: {
\t\t\t\t\tequalTo: \"#password\"
\t\t\t\t},
\t\t\t\t
\t\t\t\ttelephone: {
\t\t\t\t\trequired: true,
\t\t\t\t\t//number: true
\t\t\t\t}
\t\t\t\t
\t\t\t},
\t\t\t// Specify validation error messages
\t\t\tmessages: {
\t\t\t\tfirstname: \"";
        // line 1041
        echo ($context["error_enter_firstname"] ?? null);
        echo "\",
\t\t\t\tlastname: \"";
        // line 1042
        echo ($context["error_enter_lastname"] ?? null);
        echo "\",
\t\t\t\tstore_name: \"";
        // line 1043
        echo ($context["error_enter_agree"] ?? null);
        echo "\",
\t\t\t\tpassword: {
\t\t\t\t\trequired: \"";
        // line 1045
        echo ($context["error_enter_password"] ?? null);
        echo "\",
\t\t\t\t\tminlength: \"";
        // line 1046
        echo ($context["error_enter_password_lenght"] ?? null);
        echo "\"
\t\t\t\t},
\t\t\t\temail: \"";
        // line 1048
        echo ($context["error_enter_email_address"] ?? null);
        echo "\",
\t\t\t\tconfirm: \"";
        // line 1049
        echo ($context["error_enter_confirm_password"] ?? null);
        echo "\",
\t\t\t\ttelephone: \"";
        // line 1050
        echo ($context["error_enter_telephone"] ?? null);
        echo "\",
\t\t\t\t
\t\t\t\t
\t\t\t},
\t\t\t// Make sure the form is submitted to the destination defined
\t\t\t// in the \"action\" attribute of the form when valid
\t\t});
\t\t
\t\tif (\$('#regForm').valid()) {
\t\t\tvalid = true;
\t\t}
\t\t
\t\tif(currentTabpts===0){
\t\t ";
        // line 1063
        if (($context["text_agree"] ?? null)) {
            // line 1064
            echo "\t\t\t//if(\$(\"input[name='agree']\").prop('checked') == true){
\t\t\tif(\$(\"#pts_agree\").prop('checked') == true){
\t\t       \$(\"#agreediv\").remove();
\t\t    \tvalid = true;
\t\t    \tif (\$('#regForm').valid()) {
\t\t     \t  valid = true;
\t        \t} else {
\t        \t   \tvalid = false; 
\t        \t}
\t        \t
\t\t\t}else{
\t\t\t\t\$(\"#agreediv\").remove();
\t\t\t\t//\$(\"input[name='agree']\").after('<p id=\"agreediv\" style=\"color: red;\">";
            // line 1076
            echo ($context["error_enter_agree"] ?? null);
            echo "</p>');
\t\t\t\t\$(\"#pts_agree\").after('<p id=\"agreediv\" class=\"ptsc-sregister-wcolor\">";
            // line 1077
            echo ($context["error_enter_agree"] ?? null);
            echo "</p>');
\t\t\t\tvalid = false;
\t\t\t}
\t\t";
        }
        // line 1080
        echo "\t
\t\t";
        // line 1081
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["requiredcustom"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["requiredcustoma"]) {
            // line 1082
            echo "\t\t\t";
            if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "step_location", [], "any", false, false, false, 1082) == "one")) {
                // line 1083
                echo "\t\t\t";
                if (((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1083) == "radio") || (twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1083) == "checkbox"))) {
                    // line 1084
                    echo "\t\t\tvar returnvar = false;
\t\t\t\tconsole.log('a');
\t\t\t";
                    // line 1086
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1086) == "checkbox")) {
                        echo "\t
\t\t\t\$.each((\$('[name=\"custom_field[";
                        // line 1087
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1087);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1087);
                        echo "][]\"]')),function(k,v){
\t\t\t\tif(\$(v).prop('checked') == true) {
\t\t\t\tconsole.log('b');
\t\t\t\treturnvar = true;
\t\t\t\treturn true;
\t\t\t\t}
\t\t\t\t});
\t\t\t";
                    }
                    // line 1095
                    echo "\t\t\t
\t\t\t";
                    // line 1096
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1096) == "radio")) {
                        echo "\t\t
\t\t\t\$.each((\$('[name=\"custom_field[";
                        // line 1097
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1097);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1097);
                        echo "]\"]')),function(k,v){
\t\t\t\tif(\$(v).prop('checked') == true) {
\t\t\t\tconsole.log('b');
\t\t\t\treturnvar = true;
\t\t\t\treturn true;
\t\t\t\t}
\t\t\t\t});
\t\t";
                    }
                    // line 1105
                    echo "\t\t\t\t\t
\t\t\t\t";
                    // line 1106
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1106) == "checkbox")) {
                        echo "\t\t\t
\t\tif(returnvar == false) {
\t\t\t\$('#requiredcustoma'+";
                        // line 1108
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1108);
                        echo ").remove();
\t\t\t\$('[name=\"custom_field[";
                        // line 1109
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1109);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1109);
                        echo "][]\"]:last').parent().after('<p id=\"requiredcustoma'+";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1109);
                        echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\t\treturn false;
\t\t} else {
\t\t\t\$('#requiredcustoma'+";
                        // line 1112
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1112);
                        echo ").remove();
\t\t}
\t\t";
                    }
                    // line 1115
                    echo "\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1115) == "radio")) {
                        echo "\t
\t\tif(returnvar == false) {
\t\t\t\$('#requiredcustoma'+";
                        // line 1117
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1117);
                        echo ").remove();
\t\t\t\$('[name=\"custom_field[";
                        // line 1118
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1118);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1118);
                        echo "]\"]:last').parent().after('<p id=\"requiredcustoma'+";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1118);
                        echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\t\treturn false;
\t\t} else {
\t\t\t\$('#requiredcustoma'+";
                        // line 1121
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1121);
                        echo ").remove();
\t\t}
\t\t";
                    }
                    // line 1124
                    echo "\t\t\t";
                } else {
                    // line 1125
                    echo "
\t\tif(\$('[name=\"custom_field[";
                    // line 1126
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1126);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1126);
                    echo "]\"]').val() == '') {
\t\t\$('#requiredcustoma'+";
                    // line 1127
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1127);
                    echo ").remove();
\t\t\$('[name=\"custom_field[";
                    // line 1128
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1128);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1128);
                    echo "][]\"]').after('<p id=\"requiredcustoma'+";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1128);
                    echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\$('[name=\"custom_field[";
                    // line 1129
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1129);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1129);
                    echo "]\"]').after('<p id=\"requiredcustoma'+";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1129);
                    echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\t\treturn false;
\t\t} else {
\t\t\$('#requiredcustoma'+";
                    // line 1132
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1132);
                    echo ").remove();
\t\t}
\t\t
\t\t
\t\t\t";
                }
                // line 1137
                echo "\t\t\t";
            }
            // line 1138
            echo "\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['requiredcustoma'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1139
        echo "\t\t} else if(currentTabpts===1){
\t\t";
        // line 1140
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["requiredcustom"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["requiredcustoma"]) {
            // line 1141
            echo "\t\t\t";
            if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "step_location", [], "any", false, false, false, 1141) == "two")) {
                // line 1142
                echo "\t\t\t";
                if (((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1142) == "radio") || (twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1142) == "checkbox"))) {
                    // line 1143
                    echo "\t\t\tvar returnvar = false;
\t\t\t\tconsole.log('a');
\t\t";
                    // line 1145
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1145) == "checkbox")) {
                        echo "\t\t
\t\t\t\$.each((\$('[name=\"custom_field[";
                        // line 1146
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1146);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1146);
                        echo "][]\"]')),function(k,v){
\t\t\t\tif(\$(v).prop('checked') == true) {
\t\t\t\tconsole.log('b');
\t\t\t\treturnvar = true;
\t\t\t\treturn true;
\t\t\t\t}
\t\t\t\t});
\t\t";
                    }
                    // line 1154
                    echo "\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1154) == "radio")) {
                        echo "\t\t
\t\t\t\$.each((\$('[name=\"custom_field[";
                        // line 1155
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1155);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1155);
                        echo "]\"]')),function(k,v){
\t\t\t\tif(\$(v).prop('checked') == true) {
\t\t\t\tconsole.log('b');
\t\t\t\treturnvar = true;
\t\t\t\treturn true;
\t\t\t\t}
\t\t\t\t});
\t\t";
                    }
                    // line 1163
                    echo "
\t\t\t\t\t
\t\t";
                    // line 1165
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1165) == "checkbox")) {
                        echo "\t\t\t
\t\tif(returnvar == false) {
\t\t\t\$('#requiredcustoma'+";
                        // line 1167
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1167);
                        echo ").remove();
\t\t\t\$('[name=\"custom_field[";
                        // line 1168
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1168);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1168);
                        echo "][]\"]:last').parent().after('<p id=\"requiredcustoma'+";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1168);
                        echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\t\treturn false;
\t\t} else {
\t\t\t\$('#requiredcustoma'+";
                        // line 1171
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1171);
                        echo ").remove();
\t\t}
\t\t";
                    }
                    // line 1174
                    echo "\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1174) == "radio")) {
                        echo "\t
\t\tif(returnvar == false) {
\t\t\t\$('#requiredcustoma'+";
                        // line 1176
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1176);
                        echo ").remove();
\t\t\t\$('[name=\"custom_field[";
                        // line 1177
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1177);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1177);
                        echo "]\"]:last').parent().after('<p id=\"requiredcustoma'+";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1177);
                        echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\t\treturn false;
\t\t} else {
\t\t\t\$('#requiredcustoma'+";
                        // line 1180
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1180);
                        echo ").remove();
\t\t}
\t\t";
                    }
                    // line 1183
                    echo "\t\t";
                } else {
                    echo "\t
\t\t
\t\tif(\$('[name=\"custom_field[";
                    // line 1185
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1185);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1185);
                    echo "]\"]').val() == '') {
\t\t\$('#requiredcustoma'+";
                    // line 1186
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1186);
                    echo ").remove();
\t\t\$('[name=\"custom_field[";
                    // line 1187
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1187);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1187);
                    echo "][]\"]').after('<p id=\"requiredcustoma'+";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1187);
                    echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\$('[name=\"custom_field[";
                    // line 1188
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1188);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1188);
                    echo "]\"]').after('<p id=\"requiredcustoma'+";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1188);
                    echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\t\treturn false;
\t\t} else {
\t\t\$('#requiredcustoma'+";
                    // line 1191
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1191);
                    echo ").remove();
\t\t}
\t\t
\t\t\t";
                }
                // line 1195
                echo "\t\t\t";
            }
            // line 1196
            echo "\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['requiredcustoma'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1197
        echo "\t\t} else if(currentTabpts===2){
\t";
        // line 1198
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["requiredcustom"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["requiredcustoma"]) {
            // line 1199
            echo "\t\t\t";
            if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "step_location", [], "any", false, false, false, 1199) == "three")) {
                // line 1200
                echo "\t\t\t";
                if (((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1200) == "radio") || (twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1200) == "checkbox"))) {
                    // line 1201
                    echo "\t\t\tvar returnvar = false;
\t\t\t\tconsole.log('a');
\t\t\t";
                    // line 1203
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1203) == "checkbox")) {
                        echo "\t
\t\t\t\$.each((\$('[name=\"custom_field[";
                        // line 1204
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1204);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1204);
                        echo "][]\"]')),function(k,v){
\t\t\t\tif(\$(v).prop('checked') == true) {
\t\t\t\tconsole.log('b');
\t\t\t\treturnvar = true;
\t\t\t\treturn true;
\t\t\t\t}
\t\t\t\t});
\t\t\t";
                    }
                    // line 1212
                    echo "\t\t\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1212) == "radio")) {
                        echo "\t\t
\t\t\t\$.each((\$('[name=\"custom_field[";
                        // line 1213
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1213);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1213);
                        echo "]\"]')),function(k,v){
\t\t\t\tif(\$(v).prop('checked') == true) {
\t\t\t\tconsole.log('b');
\t\t\t\treturnvar = true;
\t\t\t\treturn true;
\t\t\t\t}
\t\t\t\t});
\t\t";
                    }
                    // line 1221
                    echo "\t\t
\t\t";
                    // line 1222
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1222) == "checkbox")) {
                        echo "\t\t\t
\t\tif(returnvar == false) {
\t\t\t\$('#requiredcustoma'+";
                        // line 1224
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1224);
                        echo ").remove();
\t\t\t\$('[name=\"custom_field[";
                        // line 1225
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1225);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1225);
                        echo "][]\"]:last').parent().after('<p id=\"requiredcustoma'+";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1225);
                        echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\t\treturn false;
\t\t} else {
\t\t\t\$('#requiredcustoma'+";
                        // line 1228
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1228);
                        echo ").remove();
\t\t}
\t\t";
                    }
                    // line 1231
                    echo "\t\t
\t\t";
                    // line 1232
                    if ((twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "type", [], "any", false, false, false, 1232) == "radio")) {
                        echo "\t
\t\tif(returnvar == false) {
\t\t\t\$('#requiredcustoma'+";
                        // line 1234
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1234);
                        echo ").remove();
\t\t\t\$('[name=\"custom_field[";
                        // line 1235
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1235);
                        echo "][";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1235);
                        echo "]\"]:last').parent().after('<p id=\"requiredcustoma'+";
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1235);
                        echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\t\treturn false;
\t\t} else {
\t\t\t\$('#requiredcustoma'+";
                        // line 1238
                        echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1238);
                        echo ").remove();
\t\t}
\t\t";
                    }
                    // line 1241
                    echo "\t\t
\t\t\t";
                } else {
                    // line 1243
                    echo "\t\t
\t\tif(\$('[name=\"custom_field[";
                    // line 1244
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1244);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1244);
                    echo "]\"]').val() == '') {
\t\t\$('#requiredcustoma'+";
                    // line 1245
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1245);
                    echo ").remove();
\t\t\$('[name=\"custom_field[";
                    // line 1246
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1246);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1246);
                    echo "][]\"]').after('<p id=\"requiredcustoma'+";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1246);
                    echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\$('[name=\"custom_field[";
                    // line 1247
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "location", [], "any", false, false, false, 1247);
                    echo "][";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1247);
                    echo "]\"]').after('<p id=\"requiredcustoma'+";
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1247);
                    echo "+'\" class=\"ptsc-sregister-wcolor\">Warning: This field is required!</p>');
\t\t\t\treturn false;
\t\t} else {
\t\t\$('#requiredcustoma'+";
                    // line 1250
                    echo twig_get_attribute($this->env, $this->source, $context["requiredcustoma"], "custom_field_id", [], "any", false, false, false, 1250);
                    echo ").remove();
\t\t}
\t\t
\t\t\t";
                }
                // line 1254
                echo "\t\t\t";
            }
            // line 1255
            echo "\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['requiredcustoma'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1256
        echo "\t\t}
\t\t
\t\t// If the valid status is true, mark the step as finished and valid:
\t\tif (valid) {
\t\t\t//document.getElementsByClassName(\"step\")[currentTabpts].className += \" finish\";
\t\t}
\t\treturn valid; // return the valid status
\t}
\t
\tfunction fixStepIndicator(n) {
\t\t// This function removes the \"active\" class of all steps...
\t\tvar i, x = document.getElementsByClassName(\"step\");
\t\tfor (i = 0; i < x.length; i++) {
\t\t\tx[i].className = x[i].className.replace(\" active\", \"\");
\t\t}
\t\t//... and adds the \"active\" class on the current step:
\t\tx[n].className += \" active\";
\t}
\t
</script>
<script type=\"text/javascript\">
\tfunction country(element,zone_id) { 
\t\t\$.ajax({
\t\t\turl: 'index.php?route=localisation/country&country_id=' + element.value,
\t\t\tdataType: 'json',
\t\t\tbeforeSend: function() {
\t\t\t\t\$('select[name=\\'store_country\\']').after(' <i class=\"fa fa-circle-o-notch fa-spin\"></i>');
\t\t\t},
\t\t\tcomplete: function() {
\t\t\t\t\$('.fa-spin').remove();
\t\t\t},
\t\t\tsuccess: function(json) {
\t\t\t\tif (json['postcode_required'] == '1') {
\t\t\t\t\t\$('input[name=\\'store_zipcode]\\']').parent().parent().addClass('required');
\t\t\t\t\t} else {
\t\t\t\t\t\$('input[name=\\'store_zipcode\\']').parent().parent().removeClass('required');
\t\t\t\t}
\t\t\t\t
\t\t\t\thtml = '<option value=\"\">";
        // line 1294
        echo ($context["text_select"] ?? null);
        echo "</option>';
\t\t\t\t
\t\t\t\tif (json['zone'] && json['zone'] != '') {
\t\t\t\t\tfor (i = 0; i < json['zone'].length; i++) {
\t\t\t\t\t\thtml += '<option value=\"' + json['zone'][i]['zone_id'] + '\"';
\t\t\t\t\t\t
\t\t\t\t\t\tif (json['zone'][i]['zone_id'] == zone_id) {
\t\t\t\t\t\t\thtml += ' selected=\"selected\"';
\t\t\t\t\t\t}
\t\t\t\t\t\t
\t\t\t\t\t\thtml += '>' + json['zone'][i]['name'] + '</option>';
\t\t\t\t\t}
\t\t\t\t\t} else {
\t\t\t\t\thtml += '<option value=\"0\">";
        // line 1307
        echo ($context["text_none"] ?? null);
        echo "</option>';
\t\t\t\t}
\t\t\t\t
\t\t\t\t\$('select[name=\\'store_state\\']').html(html);
\t\t\t},
\t\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\t//alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t}
\t\t});
\t}
\t
\t\$('select[name\$=\\'store_country\\']').trigger('change');
\tfunction show1(){
\t\tdocument.getElementById('div1').style.display ='none';
\t}
\tfunction show2(){
\t\tdocument.getElementById('div1').style.display = 'block';
\t}
\t\$( window ).on(\"load\", function() {
\t\t";
        // line 1326
        if ((($context["store_shipping_type"] ?? null) == "pts_matrix_shipping")) {
            // line 1327
            echo "\t\tdocument.getElementById('div1').style.display ='none';
\t\t";
        }
        // line 1329
        echo "\t})
</script>
<script type=\"text/javascript\">
\t// Sort the custom fields
\t\$('#account .form-group[data-sort]').detach().each(function() {
\t\tif (\$(this).attr('data-sort') >= 0 && \$(this).attr('data-sort') <= \$('#account .form-group').length) {
\t\t\t\$('#account .form-group').eq(\$(this).attr('data-sort')).before(this);
\t\t}
\t\t
\t\tif (\$(this).attr('data-sort') > \$('#account .form-group').length) {
\t\t\t\$('#account .form-group:last').after(this);
\t\t}
\t\t
\t\tif (\$(this).attr('data-sort') == \$('#account .form-group').length) {
\t\t\t\$('#account .form-group:last').after(this);
\t\t}
\t\t
\t\tif (\$(this).attr('data-sort') < -\$('#account .form-group').length) {
\t\t\t\$('#account .form-group:first').before(this);
\t\t}
\t});
\t
\t\$('input[name=\\'customer_group_id\\']').on('change', function() {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=extension/purpletree_multivendor/multivendor/sellerregister|customfield&customer_group_id=' + this.value,
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\t//\$('.custom-field').hide();
\t\t\t\t//\$('.custom-field').removeClass('required');
\t\t\t\t
\t\t\t\t/* for (i = 0; i < json.length; i++) {
\t\t\t\t\tcustom_field = json[i];
\t\t\t\t\t
\t\t\t\t\t\$('#custom-field' + custom_field['custom_field_id']).show();
\t\t\t\t\t
\t\t\t\t\tif (custom_field['required']) {
\t\t\t\t\t\t\$('#custom-field' + custom_field['custom_field_id']).addClass('required');
\t\t\t\t\t}
\t\t\t\t} */
\t\t\t},
\t\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\t//alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t}
\t\t});
\t});
\t
\t\$('input[name=\\'customer_group_id\\']:checked').trigger('change');
</script> 
<script type=\"text/javascript\"><!--
\t\$('.filechangepts').on('change', function(e) {
\tvar ext = this.value.match(/\\.([^\\.]+)\$/)[1];
\t  switch (ext) {
\t\tcase 'jpg':
\t\tcase 'jpeg':
\t\tcase 'JPG':
\t\tcase 'JPEG':
\t\tcase 'png':
\t\tcase 'PNG':
\t\tcase 'gif':
\t\tcase 'GIF':
\t\t  break;
\t\tdefault:
\t\t  alert('File Type Not allowed');
\t\t  this.value = '';
\t  }
\t});
\t\$('button[id^=\\'button-custom-field\\']').on('click', function() {
\t\tvar element = this;
\t\t
\t\t\$('#form-upload').remove();
\t\t
\t\t\$('body').prepend('<form enctype=\"multipart/form-data\" id=\"form-upload\" class=\"ptsc-productl-nodisplay\"><input type=\"file\" name=\"file\" /></form>');
\t\t
\t\t\$('#form-upload input[name=\\'file\\']').trigger('click');
\t\t
\t\tif (typeof timer != 'undefined') {
\t\t\tclearInterval(timer);
\t\t}
\t\t
\t\ttimer = setInterval(function() {
\t\t\tif (\$('#form-upload input[name=\\'file\\']').val() != '') {
\t\t\t\tclearInterval(timer);
\t\t\t\t
\t\t\t\t\$.ajax({
\t\t\t\t\turl: 'index.php?route=tool/upload',
\t\t\t\t\ttype: 'post',
\t\t\t\t\tdataType: 'json',
\t\t\t\t\tdata: new FormData(\$('#form-upload')[0]),
\t\t\t\t\tcache: false,
\t\t\t\t\tcontentType: false,
\t\t\t\t\tprocessData: false,
\t\t\t\t\tbeforeSend: function() {
\t\t\t\t\t\t\$(element).button('loading'); 
\t\t\t\t\t},
\t\t\t\t\tcomplete: function() {
\t\t\t\t\t\t\$(element).button('reset');
\t\t\t\t\t},
\t\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\t\$(element).parent().find('.text-danger').remove();
\t\t\t\t\t\t
\t\t\t\t\t\tif (json['error']) {
\t\t\t\t\t\t\t\$(element).parent().find('input').after('<div class=\"text-danger\">' + json['error'] + '</div>');
\t\t\t\t\t\t}
\t\t\t\t\t\t 
\t\t\t\t\t\tif (json['success']) {
\t\t\t\t\t\t\talert(json['success']);
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\$(element).parent().find('input').val(json['code']);
\t\t\t\t\t\t\t\$(element).parent().find('span').remove();
\t\t\t\t\t\t\t\$(element).parent().find('input').after(\"<span>\"+json['filename']+\"</span>\");
\t\t\t\t\t\t}
\t\t\t\t\t},
\t\t\t\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\t\t\t//alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\t\t}
\t\t\t\t});
\t\t\t}
\t\t}, 500); 
\t});
//--></script>
<script type=\"text/javascript\"><!--
\$('.date').datetimepicker({
\tlanguage: '";
        // line 1451
        echo ($context["datepicker"] ?? null);
        echo "',
\tpickTime: false
});

\$('.time').datetimepicker({
\tlanguage: '";
        // line 1456
        echo ($context["datepicker"] ?? null);
        echo "',
\tpickDate: false
});

\$('.datetime').datetimepicker({
\tlanguage: '";
        // line 1461
        echo ($context["datepicker"] ?? null);
        echo "',
\tpickDate: true,
\tpickTime: true
});
// seller area 
  \$('input[name=\\'sellerarea\\']').autocompletepts({
\t  'source': function(request, response) {
\t\t  \$.ajax({
\t\t\t  url: 'index.php?route=extension/purpletree_multivendor/multivendor/sellerstore|sellerarea&filter_name=' + encodeURIComponent(request),
\t\t\t  dataType: 'json',
\t\t\t  success: function(json) {
\t\t\t\t  response(\$.map(json, function(item) {
\t\t\t\t\t  return {
\t\t\t\t\t\t  label: item['name'],
\t\t\t\t\t\t  value: item['area_id']
\t\t\t\t\t  }
\t\t\t\t  }));
\t\t\t  }
\t\t  });
\t  },
\t  'select': function(item) {
\t\t  \$('input[name=\\'sellerarea \\']').val('');

\t\t  \$('#seller-area' + item['value']).remove();

\t\t  \$('#seller-area').append('<div id=\"seller-area' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"seller_area[]\" value=\"' + item['value'] + '\" /></div>');
\t  }
  });

  \$('#seller-area').delegate('.fa-minus-circle', 'click', function() {
\t  \$(this).parent().remove();
  });
  
  \$('select[name=\"seller_area_selection_type\"]').on('change', function(){
\t\tvar selectid = \$(this).val();
\t\tif(selectid==\"0\"){
\t\t\t\$('#input-sellerarea').prop('disabled', true);\t\t\t
\t\t\t\$('#seller-area').empty();\t\t\t
\t\t\t} else{
\t\t\t\$('#input-sellerarea').prop('disabled', false);\t\t\t
\t\t}
\t});
//--></script> 
<style>
\t.pts-form-group.custom-field {
\t\tdisplay:block !important;
\t}
\t#button-menu {
\t\tdisplay: none;
\t}
</style>

";
        // line 1513
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/catalog/view/template/multivendor/sellerregister.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  4056 => 1513,  4001 => 1461,  3993 => 1456,  3985 => 1451,  3861 => 1329,  3857 => 1327,  3855 => 1326,  3833 => 1307,  3817 => 1294,  3777 => 1256,  3771 => 1255,  3768 => 1254,  3761 => 1250,  3751 => 1247,  3743 => 1246,  3739 => 1245,  3733 => 1244,  3730 => 1243,  3726 => 1241,  3720 => 1238,  3710 => 1235,  3706 => 1234,  3701 => 1232,  3698 => 1231,  3692 => 1228,  3682 => 1225,  3678 => 1224,  3673 => 1222,  3670 => 1221,  3657 => 1213,  3652 => 1212,  3639 => 1204,  3635 => 1203,  3631 => 1201,  3628 => 1200,  3625 => 1199,  3621 => 1198,  3618 => 1197,  3612 => 1196,  3609 => 1195,  3602 => 1191,  3592 => 1188,  3584 => 1187,  3580 => 1186,  3574 => 1185,  3568 => 1183,  3562 => 1180,  3552 => 1177,  3548 => 1176,  3542 => 1174,  3536 => 1171,  3526 => 1168,  3522 => 1167,  3517 => 1165,  3513 => 1163,  3500 => 1155,  3495 => 1154,  3482 => 1146,  3478 => 1145,  3474 => 1143,  3471 => 1142,  3468 => 1141,  3464 => 1140,  3461 => 1139,  3455 => 1138,  3452 => 1137,  3444 => 1132,  3434 => 1129,  3426 => 1128,  3422 => 1127,  3416 => 1126,  3413 => 1125,  3410 => 1124,  3404 => 1121,  3394 => 1118,  3390 => 1117,  3384 => 1115,  3378 => 1112,  3368 => 1109,  3364 => 1108,  3359 => 1106,  3356 => 1105,  3343 => 1097,  3339 => 1096,  3336 => 1095,  3323 => 1087,  3319 => 1086,  3315 => 1084,  3312 => 1083,  3309 => 1082,  3305 => 1081,  3302 => 1080,  3295 => 1077,  3291 => 1076,  3277 => 1064,  3275 => 1063,  3259 => 1050,  3255 => 1049,  3251 => 1048,  3246 => 1046,  3242 => 1045,  3237 => 1043,  3233 => 1042,  3229 => 1041,  3156 => 971,  3152 => 970,  3147 => 968,  3143 => 967,  3133 => 959,  3123 => 951,  3118 => 948,  3116 => 947,  3100 => 933,  3095 => 930,  3090 => 927,  3088 => 926,  3064 => 905,  3060 => 904,  3051 => 897,  3045 => 896,  3042 => 895,  3037 => 892,  3031 => 891,  3029 => 890,  3010 => 886,  3002 => 883,  2987 => 882,  2984 => 881,  2981 => 880,  2978 => 879,  2974 => 877,  2968 => 875,  2966 => 874,  2947 => 870,  2940 => 868,  2925 => 867,  2922 => 866,  2919 => 865,  2916 => 864,  2912 => 862,  2906 => 860,  2904 => 859,  2885 => 855,  2878 => 853,  2863 => 852,  2860 => 851,  2857 => 850,  2854 => 849,  2850 => 847,  2844 => 845,  2842 => 844,  2830 => 843,  2822 => 842,  2818 => 841,  2803 => 840,  2800 => 839,  2797 => 838,  2794 => 837,  2775 => 834,  2769 => 833,  2754 => 832,  2751 => 831,  2748 => 830,  2745 => 829,  2741 => 827,  2735 => 825,  2733 => 824,  2717 => 823,  2711 => 822,  2696 => 821,  2693 => 820,  2690 => 819,  2687 => 818,  2683 => 816,  2677 => 814,  2675 => 813,  2672 => 812,  2665 => 811,  2660 => 810,  2652 => 809,  2649 => 808,  2644 => 806,  2636 => 805,  2633 => 804,  2630 => 803,  2626 => 802,  2621 => 800,  2606 => 799,  2603 => 798,  2600 => 797,  2597 => 796,  2593 => 794,  2587 => 792,  2585 => 791,  2582 => 790,  2575 => 789,  2570 => 788,  2562 => 787,  2559 => 786,  2554 => 784,  2546 => 783,  2543 => 782,  2540 => 781,  2536 => 780,  2532 => 779,  2519 => 778,  2516 => 777,  2513 => 776,  2510 => 775,  2506 => 773,  2500 => 771,  2498 => 770,  2489 => 768,  2481 => 766,  2473 => 764,  2470 => 763,  2466 => 762,  2462 => 761,  2454 => 760,  2447 => 758,  2434 => 757,  2431 => 756,  2428 => 755,  2424 => 754,  2419 => 751,  2415 => 750,  2409 => 746,  2403 => 744,  2401 => 743,  2397 => 742,  2392 => 740,  2385 => 736,  2382 => 735,  2378 => 734,  2367 => 730,  2364 => 729,  2362 => 728,  2359 => 727,  2355 => 726,  2346 => 722,  2342 => 721,  2339 => 720,  2337 => 719,  2328 => 712,  2321 => 709,  2317 => 708,  2306 => 704,  2298 => 703,  2293 => 701,  2289 => 699,  2287 => 698,  2283 => 696,  2277 => 695,  2274 => 694,  2269 => 691,  2263 => 690,  2261 => 689,  2242 => 685,  2234 => 682,  2219 => 681,  2216 => 680,  2213 => 679,  2210 => 678,  2206 => 676,  2200 => 674,  2198 => 673,  2179 => 669,  2172 => 667,  2157 => 666,  2154 => 665,  2151 => 664,  2148 => 663,  2144 => 661,  2138 => 659,  2136 => 658,  2117 => 654,  2110 => 652,  2095 => 651,  2092 => 650,  2089 => 649,  2086 => 648,  2082 => 646,  2076 => 644,  2074 => 643,  2062 => 642,  2054 => 641,  2050 => 640,  2035 => 639,  2032 => 638,  2029 => 637,  2026 => 636,  2007 => 633,  2001 => 632,  1986 => 631,  1983 => 630,  1980 => 629,  1977 => 628,  1973 => 626,  1967 => 624,  1965 => 623,  1949 => 622,  1943 => 621,  1928 => 620,  1925 => 619,  1922 => 618,  1919 => 617,  1915 => 615,  1909 => 613,  1907 => 612,  1904 => 611,  1897 => 610,  1892 => 609,  1884 => 608,  1881 => 607,  1876 => 605,  1868 => 604,  1865 => 603,  1862 => 602,  1858 => 601,  1853 => 599,  1838 => 598,  1835 => 597,  1832 => 596,  1829 => 595,  1825 => 593,  1819 => 591,  1817 => 590,  1814 => 589,  1807 => 588,  1802 => 587,  1794 => 586,  1791 => 585,  1786 => 583,  1778 => 582,  1775 => 581,  1772 => 580,  1768 => 579,  1764 => 578,  1751 => 577,  1748 => 576,  1745 => 575,  1742 => 574,  1738 => 572,  1732 => 570,  1730 => 569,  1721 => 567,  1713 => 565,  1705 => 563,  1702 => 562,  1698 => 561,  1694 => 560,  1686 => 559,  1679 => 557,  1666 => 556,  1663 => 555,  1660 => 554,  1656 => 553,  1652 => 551,  1648 => 549,  1641 => 545,  1637 => 544,  1633 => 542,  1630 => 541,  1626 => 539,  1619 => 535,  1615 => 534,  1611 => 532,  1608 => 531,  1604 => 529,  1597 => 525,  1593 => 524,  1589 => 522,  1586 => 521,  1582 => 519,  1575 => 515,  1571 => 514,  1567 => 512,  1564 => 511,  1560 => 509,  1553 => 505,  1549 => 504,  1545 => 502,  1543 => 501,  1537 => 498,  1533 => 497,  1529 => 495,  1525 => 493,  1518 => 489,  1514 => 488,  1510 => 486,  1507 => 485,  1503 => 483,  1498 => 480,  1492 => 478,  1490 => 477,  1484 => 476,  1480 => 475,  1476 => 473,  1473 => 472,  1469 => 470,  1460 => 466,  1456 => 465,  1452 => 463,  1449 => 462,  1445 => 460,  1436 => 456,  1432 => 455,  1428 => 453,  1426 => 452,  1423 => 451,  1419 => 450,  1410 => 446,  1406 => 445,  1402 => 443,  1400 => 442,  1397 => 441,  1393 => 440,  1384 => 436,  1380 => 435,  1376 => 433,  1374 => 432,  1370 => 430,  1366 => 429,  1360 => 425,  1351 => 423,  1344 => 422,  1340 => 421,  1336 => 419,  1332 => 417,  1326 => 415,  1324 => 414,  1321 => 413,  1316 => 411,  1311 => 410,  1306 => 408,  1301 => 407,  1299 => 406,  1290 => 402,  1286 => 400,  1284 => 399,  1281 => 398,  1276 => 396,  1272 => 395,  1264 => 392,  1260 => 391,  1257 => 390,  1255 => 389,  1252 => 388,  1248 => 387,  1240 => 384,  1236 => 383,  1233 => 382,  1231 => 381,  1228 => 380,  1226 => 379,  1223 => 378,  1218 => 375,  1214 => 374,  1204 => 367,  1199 => 365,  1195 => 363,  1191 => 362,  1184 => 357,  1178 => 356,  1170 => 354,  1162 => 352,  1159 => 351,  1155 => 350,  1151 => 349,  1147 => 348,  1142 => 346,  1139 => 345,  1137 => 344,  1134 => 343,  1132 => 342,  1128 => 340,  1124 => 339,  1116 => 336,  1112 => 335,  1109 => 334,  1107 => 333,  1104 => 332,  1099 => 330,  1095 => 329,  1088 => 325,  1085 => 324,  1083 => 323,  1080 => 322,  1076 => 321,  1068 => 316,  1065 => 315,  1063 => 314,  1060 => 313,  1057 => 312,  1053 => 310,  1045 => 307,  1041 => 306,  1036 => 304,  1032 => 302,  1026 => 300,  1024 => 299,  1018 => 298,  1014 => 297,  1005 => 290,  1002 => 289,  997 => 286,  993 => 285,  987 => 282,  983 => 281,  980 => 280,  978 => 279,  973 => 277,  969 => 275,  963 => 274,  960 => 273,  955 => 270,  949 => 269,  947 => 268,  928 => 264,  920 => 261,  905 => 260,  902 => 259,  899 => 258,  896 => 257,  892 => 255,  886 => 253,  884 => 252,  865 => 248,  858 => 246,  843 => 245,  840 => 244,  837 => 243,  834 => 242,  830 => 240,  824 => 238,  822 => 237,  803 => 233,  796 => 231,  781 => 230,  778 => 229,  775 => 228,  772 => 227,  768 => 225,  762 => 223,  760 => 222,  748 => 221,  740 => 220,  736 => 219,  721 => 218,  718 => 217,  715 => 216,  712 => 215,  693 => 212,  687 => 211,  672 => 210,  669 => 209,  666 => 208,  663 => 207,  659 => 205,  653 => 203,  651 => 202,  635 => 201,  629 => 200,  614 => 199,  611 => 198,  608 => 197,  605 => 196,  601 => 194,  595 => 192,  593 => 191,  590 => 190,  583 => 189,  578 => 188,  570 => 187,  567 => 186,  562 => 184,  554 => 183,  551 => 182,  548 => 181,  544 => 180,  539 => 178,  524 => 177,  521 => 176,  518 => 175,  515 => 174,  511 => 172,  505 => 170,  503 => 169,  500 => 168,  493 => 167,  488 => 166,  480 => 165,  477 => 164,  472 => 162,  464 => 161,  461 => 160,  458 => 159,  454 => 158,  450 => 157,  437 => 156,  434 => 155,  431 => 154,  428 => 153,  424 => 151,  418 => 149,  416 => 148,  407 => 146,  399 => 144,  391 => 142,  388 => 141,  384 => 140,  380 => 139,  372 => 138,  365 => 136,  352 => 135,  349 => 134,  346 => 133,  342 => 132,  338 => 130,  332 => 128,  330 => 127,  324 => 126,  320 => 125,  315 => 122,  309 => 120,  307 => 119,  301 => 118,  297 => 117,  292 => 114,  286 => 112,  284 => 111,  278 => 110,  274 => 109,  269 => 106,  263 => 104,  261 => 103,  255 => 102,  251 => 101,  245 => 97,  239 => 95,  237 => 94,  231 => 93,  227 => 92,  222 => 89,  216 => 88,  214 => 87,  208 => 86,  204 => 85,  192 => 80,  186 => 77,  182 => 76,  178 => 74,  172 => 71,  168 => 70,  164 => 68,  161 => 67,  157 => 66,  153 => 65,  145 => 64,  142 => 63,  140 => 62,  129 => 54,  125 => 53,  113 => 48,  104 => 42,  96 => 37,  88 => 32,  78 => 25,  74 => 23,  68 => 22,  65 => 21,  59 => 19,  57 => 18,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/catalog/view/template/multivendor/sellerregister.twig", "C:\\wamp\\www\\tutor\\extension\\purpletree_multivendor\\catalog\\view\\template\\multivendor\\sellerregister.twig");
    }
}

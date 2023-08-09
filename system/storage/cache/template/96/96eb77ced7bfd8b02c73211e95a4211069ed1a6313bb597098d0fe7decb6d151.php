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

/* extension/purpletree_multivendor/admin/view/template/module/purpletree_multivendor.twig */
class __TwigTemplate_3cc8708e9ea9fe4b3ec6ca85758a0257011517e19d362d6ce06ff0b24dc76aae extends Template
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
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"float-end\">
        <button type=\"submit\" form=\"form-purpletree-multivendor\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
\t\t<a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default btn-light\"><i class=\"fa fa-reply\"></i></a>
\t\t";
        // line 8
        if (($context["helpcheck"] ?? null)) {
            // line 9
            echo "\t\t\t\t<a href=\"";
            echo ($context["helplink"] ?? null);
            echo "\" rel=”nofollow”  target=\"_blank\" id=\"button-pts-help\" class=\"btn\"><img src=\"";
            echo ($context["helpimage"] ?? null);
            echo "\" alt=\"Help\" width=\"85\" height=\"43\"></a>
\t\t   ";
        }
        // line 11
        echo "\t  </div>
      <h1>";
        // line 12
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ol class=\"breadcrumb\">
        ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 15
            echo "          <li class=\"breadcrumb-item\"><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 15);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 15);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "      </ol>
    </div>
  </div>
  <div class=\"container-fluid\">
  ";
        // line 21
        if (($context["error_warning"] ?? null)) {
            // line 22
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
\t</div>
    ";
        }
        // line 26
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 27
            echo "    <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
\t</div>
    ";
        }
        // line 31
        echo "    ";
        if (($context["master_id"] ?? null)) {
            // line 32
            echo "      <div class=\"alert alert-warning\"><i class=\"fas fa-exclamation-circle\"></i> ";
            echo ($context["text_variant"] ?? null);
            echo "</div>
    ";
        }
        // line 34
        echo "    <div class=\"card\">
      <div class=\"card-header\"><i class=\"fas fa-pencil-alt\"></i> ";
        // line 35
        echo ($context["text_edit"] ?? null);
        echo "</div>
      <div class=\"card-body\">
        <form action=\"";
        // line 37
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-purpletree-multivendor\" class=\"form-horizontal\">

          <ul class=\"nav nav-tabs\">
            <li class=\"nav-item\"><a href=\"#tab-general\" data-bs-toggle=\"tab\" class=\"nav-link active\">";
        // line 40
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-seller\" data-bs-toggle=\"tab\" class=\"nav-link\">";
        // line 41
        echo ($context["text_seller"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-subscription\" data-bs-toggle=\"tab\" class=\"nav-link\">";
        // line 42
        echo ($context["text_subscription"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-development\" data-bs-toggle=\"tab\" class=\"nav-link\">";
        // line 43
        echo ($context["text_development"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-hyperlocal\" data-bs-toggle=\"tab\" class=\"nav-link\">";
        // line 44
        echo ($context["entry_seller_areaheading"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-other\" data-bs-toggle=\"tab\" class=\"nav-link\">";
        // line 45
        echo ($context["text_other_settings"] ?? null);
        echo "</a></li>
            <li class=\"nav-item\"><a href=\"#tab-seller-reg\" data-bs-toggle=\"tab\" class=\"nav-link\">";
        // line 46
        echo ($context["text_seller_reg_settings"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab-general\">
\t<div class=\"form-group py-1 row\">
\t\t\t\t\t<label class=\"col-sm-2 col-form-label control-label\" for=\"input-status\">";
        // line 51
        echo ($context["entry_status"] ?? null);
        echo "</label>
\t\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<select name=\"module_purpletree_multivendor_status\" id=\"input-status\" class=\"form-select\">
\t\t\t\t\t";
        // line 54
        if (($context["module_purpletree_multivendor_status"] ?? null)) {
            // line 55
            echo "\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
\t\t\t\t\t<option value=\"0\">";
            // line 56
            echo ($context["text_disabled"] ?? null);
            echo "</option>
\t\t\t\t\t";
        } else {
            // line 58
            echo "\t\t\t\t\t<option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            // line 59
            echo ($context["text_disabled"] ?? null);
            echo "</option>
\t\t\t\t\t";
        }
        // line 61
        echo "\t\t\t\t\t</select>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-group py-1 required\">
\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t<input type=\"hidden\" name=\"module_purpletree_multivendor_process_data\" value=\"";
        // line 66
        echo ($context["module_purpletree_multivendor_process_data"] ?? null);
        echo "\" class=\"form-control\" id=\"setlicensee\"/>
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t<input type=\"hidden\" name=\"module_purpletree_multivendor_validate_text\" value=\"";
        // line 68
        echo ($context["module_purpletree_multivendor_validate_text"] ?? null);
        echo "\">
\t\t\t\t\t<input type=\"hidden\" name=\"module_purpletree_multivendor_live_validate_text\" value=\"";
        // line 69
        echo ($context["module_purpletree_multivendor_live_validate_text"] ?? null);
        echo "\">
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t<input type=\"hidden\" name=\"module_purpletree_multivendor_encypt_text\" value=\"";
        // line 71
        echo ($context["module_purpletree_multivendor_encypt_text"] ?? null);
        echo "\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-sm-12 col-sm-offset-2 offset-md-2\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-primary ptsc-mv-licebtnpadd\" id=\"getLicensee\">";
        // line 74
        echo ($context["button_get_license"] ?? null);
        echo "</button>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t
\t\t\t\t<div id=\"licenseModal\" class=\"modal pts-modal\">
\t\t\t\t<!-- Modal content -->
\t\t\t\t\t<div class=\"modal-content ptsc-modal-content\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-lg-12 liceform\">
\t\t\t\t\t<span class=\"close ptsc-close\">&times;</span>\t\t
\t\t\t\t\t<div class=\"alert alert-danger col-lg-12 ptsc-storefrm-nodisplay\" id=\"modal_lic_error\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"d-flex py-1 ptsc-mv-licemargt\" name=\"Licencekeyval1\">\t\t\t\t\t\t
\t\t\t\t\t<div class=\"col-lg-8 ptsc-mv-enter_lice\">
\t\t\t\t\t<label class=\"control-label col-form-label\" for=\"input-name\">";
        // line 88
        echo ($context["enter_license_key1"] ?? null);
        echo "</label>
\t\t\t\t\t<input name=\"\" id=\"licenskey1\" value=\"\" placeholder=\"";
        // line 89
        echo ($context["enter_license_key1"] ?? null);
        echo "\" class=\"form-control\" autocomplete=\"off\" type=\"text\" name=\"Licencekeyval\" /><ul class=\"dropdown-menu\"></ul>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-lg-2\" style=\"padding-top: 35px;\">
\t\t\t\t\t<label class=\"control-label col-form-label ptsc-mv-okbtncol\" for=\"input-name\">.</label>
\t\t\t\t\t<input value=\"";
        // line 93
        echo ($context["button_ok"] ?? null);
        echo "\" class=\"btn btn-primary okbtn\" type=\"button\" onclick=\"savelicc()\"/>\t\t\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-lg-12 ptsc-mv-dontliceleft\">
\t\t\t\t\t<input value=\"";
        // line 97
        echo ($context["dont_have_lisence_key"] ?? null);
        echo "\" class=\"btn btn-primary licencekey2 ptsc-mv-dontlicemart\" type=\"button\" onclick=\"dontlice()\"/>\t
\t\t\t\t\t</div>\t\t\t\t\t
\t\t\t\t\t<div class=\"orderdiv col-lg-12 form-group p-0 ptsc-storefrm-nodisplay\">
\t\t\t\t\t<label class=\"control-label col-form-label\" for=\"input-name\">";
        // line 100
        echo ($context["entry_order_id"] ?? null);
        echo "</label>
\t\t\t\t\t<input name=\"order_id\" id=\"order_id\" value=\"\" placeholder=\"";
        // line 101
        echo ($context["entry_order_id"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" autocomplete=\"off\" type=\"text\"><ul class=\"dropdown-menu\" ></ul>
\t\t\t\t\t<div class=\" py-1\">
\t\t\t\t\t<label class=\"control-label col-form-label\" for=\"input-name\">";
        // line 103
        echo ($context["entry_email_id"] ?? null);
        echo "</label>
\t\t\t\t\t<input name=\"email_id\" id=\"email_id\" value=\"\" placeholder=\"";
        // line 104
        echo ($context["entry_email_id"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" autocomplete=\"off\" type=\"text\"><ul class=\"dropdown-menu\"></ul>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"text-center col-lg-12  py-1\">
\t\t\t\t\t<input value=\"";
        // line 107
        echo ($context["button_submit"] ?? null);
        echo "\" class=\"btn btn-primary getlicbtn ptsc-mv-getlicpama\"  type=\"button\" onclick=\"getlicense()\"/>
\t\t\t\t\t</div>
\t\t\t\t\t</div>\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t</div>\t
\t\t\t\t</div>\t
\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<h3>";
        // line 118
        echo ($context["vendor_heading"] ?? null);
        echo "</h3>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-commission\">";
        // line 122
        echo ($context["entry_commission_status"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_commission_status\" class=\"form-select\" id = \"input-commission\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 125
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["status"]) {
            // line 126
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            if ((($context["module_purpletree_multivendor_commission_status"] ?? null) == twig_get_attribute($this->env, $this->source, $context["status"], "order_status_id", [], "any", false, false, false, 126))) {
                echo " selected=\"selected\" ";
            } elseif (((($context["module_purpletree_multivendor_commission_status"] ?? null) == "") && (twig_get_attribute($this->env, $this->source, $context["status"], "name", [], "any", false, false, false, 126) == "Complete"))) {
                echo " selected=\"selected\" ";
            }
            echo " value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["status"], "order_status_id", [], "any", false, false, false, 126);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["status"], "name", [], "any", false, false, false, 126);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 129
        if (($context["commission_status_error"] ?? null)) {
            // line 130
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["commission_status_error"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 132
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-refund\">";
        // line 137
        echo ($context["entry_refund_status"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_refund_status\" class=\"form-select\" id = \"input-refund\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 140
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["return_actions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["actions"]) {
            // line 141
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option ";
            if ((($context["module_purpletree_multivendor_refund_status"] ?? null) == twig_get_attribute($this->env, $this->source, $context["actions"], "return_action_id", [], "any", false, false, false, 141))) {
                echo " selected=\"selected\" ";
            } elseif (((($context["module_purpletree_multivendor_refund_status"] ?? null) == "") && (twig_get_attribute($this->env, $this->source, $context["actions"], "name", [], "any", false, false, false, 141) == "Refunded"))) {
                echo " selected=\"selected\" ";
            }
            echo " value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["actions"], "return_action_id", [], "any", false, false, false, 141);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["actions"], "name", [], "any", false, false, false, 141);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actions'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 143
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 144
        if (($context["commission_status_error"] ?? null)) {
            // line 145
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["commission_status_error"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 147
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 152
        echo ($context["text_purpletreeshipping_type"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_shippingtype\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 155
        if (($context["module_purpletree_multivendor_shippingtype"] ?? null)) {
            // line 156
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_purpletreeshipping"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 157
            echo ($context["text_purpletreeshipping_geozone"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 159
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_purpletreeshipping"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 160
            echo ($context["text_purpletreeshipping_geozone"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 162
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-commissionn\">";
        // line 168
        echo ($context["entry_commission"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"number\" min=\"0\" name=\"module_purpletree_multivendor_commission\" class=\"form-control\" value=\"";
        // line 170
        echo ((array_key_exists("module_purpletree_multivendor_commission", $context)) ? (($context["module_purpletree_multivendor_commission"] ?? null)) : (""));
        echo "\" id = \"input-commissionn\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 171
        if (($context["commission_error"] ?? null)) {
            // line 172
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["commission_error"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 174
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!--fix global commission-->
\t\t\t\t\t\t\t\t\t\t  <div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-fix-commissionn\">";
        // line 180
        echo ($context["text_fix_commission"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"module_purpletree_multivendor_fix_commission\" class=\"form-control\" value=\"";
        // line 182
        echo ((array_key_exists("module_purpletree_multivendor_fix_commission", $context)) ? (($context["module_purpletree_multivendor_fix_commission"] ?? null)) : (""));
        echo "\" id = \"input-fix-commissionn\"/>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!-- End fix global commission-->
\t\t\t\t\t\t\t\t\t\t<!--Shipping Commission-->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 190
        echo ($context["entry_shipping_commission"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"module_purpletree_multivendor_shipping_commission\" class=\"form-control\" value=\"";
        // line 192
        echo ((array_key_exists("module_purpletree_multivendor_shipping_commission", $context)) ? (($context["module_purpletree_multivendor_shipping_commission"] ?? null)) : (""));
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 193
        if (($context["shipping_commission_error"] ?? null)) {
            // line 194
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["shipping_commission_error"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 196
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!--Shipping Commission-->
\t\t\t\t\t\t\t\t\t\t<!--Seller group config-->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 203
        echo ($context["commission_from_seller_group"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_group\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 206
        if (($context["module_purpletree_multivendor_seller_group"] ?? null)) {
            // line 207
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 208
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 210
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 211
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 213
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!--Seller group config-->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 220
        echo ($context["Commission_invoice_footer_text"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 222
        echo ($context["Commission_invoice_footer_text"] ?? null);
        echo "\" name=\"module_purpletree_multivendor_footer_text\" class=\"form-control\" value=\"";
        echo ($context["module_purpletree_multivendor_footer_text"] ?? null);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 228
        echo ($context["entry_seller_manage_order"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_manage_order\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 231
        if (($context["module_purpletree_multivendor_seller_manage_order"] ?? null)) {
            // line 232
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 233
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 235
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 236
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 238
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!-- quick order -->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-allow_order_status\">";
        // line 245
        echo ($context["entry_allow_order_status"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_allow_order_status[]\" class=\"form-select ptsc-mv-selldasheig\"id=\"input-allow_order_status\" multiple>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 249
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["allow_order_statuse3"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 250
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 251
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "selected", [], "any", false, false, false, 251) == "selected")) {
                // line 252
                echo "\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                // line 253
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 253);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 253);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t    ";
            } else {
                // line 256
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 256);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 256);
                echo "</option>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 259
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 260
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-allow_order_status\"> ";
        // line 267
        echo ($context["entry_seller_dashboard_icon"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_icons_status[]\" class=\"form-select ptsc-mv-selldasheig\"id=\"input-allow_order_status\" multiple>

\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 272
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["allow_icon_statuse"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["allow_icon_status"]) {
            // line 273
            echo "                                                       
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
            // line 274
            echo twig_get_attribute($this->env, $this->source, $context["allow_icon_status"], "id", [], "any", false, false, false, 274);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["allow_icon_status"], "selected", [], "any", false, false, false, 274) == "selected")) {
                echo " selected=\"selected\" ";
            }
            echo " >";
            echo twig_get_attribute($this->env, $this->source, $context["allow_icon_status"], "value", [], "any", false, false, false, 274);
            echo "</option>\t
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['allow_icon_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 277
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!-- end Dashboard  icons -->
\t\t\t\t\t\t\t\t\t\t \t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-customer_manage_order\">";
        // line 284
        echo ($context["entry_customer_manage_order"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_customer_manage_order\" class=\"form-select\"id=\"input-customer_manage_order\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 287
        if (($context["module_purpletree_multivendor_customer_manage_order"] ?? null)) {
            // line 288
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 289
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 291
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 292
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 294
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t    
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t";
        // line 300
        if ((($context["quick_order_check"] ?? null) == 1)) {
            echo "\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-quick_order_tab_position\">";
            // line 303
            echo ($context["entry_quick_order_tab_position"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select id = \"input-quick_order_tab_position\" name=\"module_purpletree_multivendor_quick_order_tab_position\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 306
            if (($context["module_purpletree_multivendor_quick_order_tab_position"] ?? null)) {
                // line 307
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
                echo ($context["text_last"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
                // line 308
                echo ($context["text_first"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
            } else {
                // line 310
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
                echo ($context["text_last"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
                // line 311
                echo ($context["text_first"] ?? null);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 313
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-api\">";
            // line 319
            echo ($context["entry_api_google"] ?? null);
            echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"module_purpletree_multivendor_quick_order_api\" class=\"form-control\" value=\"";
            // line 321
            echo ((array_key_exists("module_purpletree_multivendor_quick_order_api", $context)) ? (($context["module_purpletree_multivendor_quick_order_api"] ?? null)) : (""));
            echo "\" id = \"input-api\"/>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 325
        echo "\t
\t\t\t\t\t\t\t\t\t\t<!-- end quick order -->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-seller_approv\">";
        // line 329
        echo ($context["entry_seller_approval"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_approval\" class=\"form-select\" id = \"input-seller_approv\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 332
        if (($context["module_purpletree_multivendor_seller_approval"] ?? null)) {
            // line 333
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 334
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 336
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 337
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 339
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 345
        echo ($context["entry_product_approval"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_product_approval\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 348
        if (($context["module_purpletree_multivendor_product_approval"] ?? null)) {
            // line 349
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 350
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 352
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 353
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 355
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 361
        echo ($context["entry_allow_category"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_allow_categorytype\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 364
        if (($context["module_purpletree_multivendor_allow_categorytype"] ?? null)) {
            // line 365
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_selected_categories"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 366
            echo ($context["text_allowed_categories"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 368
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_selected_categories"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 369
            echo ($context["text_allowed_categories"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 371
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 372
        if (($context["module_purpletree_multivendor_allow_categorytype"] ?? null)) {
            // line 373
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"category\" value=\"\" placeholder=\"";
            echo ($context["entry_category"] ?? null);
            echo "\" disabled id=\"input-category\" list=\"list-category\" class=\"form-control\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 375
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"category\" value=\"\" placeholder=\"";
            echo ($context["entry_category"] ?? null);
            echo "\" id=\"input-category\" list=\"list-category\" class=\"form-control\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 377
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<datalist id=\"list-category\"></datalist>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"product-category\" class=\"well well-sm form-control ptsc-storef-heioflow\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 379
        if (($context["module_purpletree_multivendor_allow_category"] ?? null)) {
            // line 380
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["module_purpletree_multivendor_allow_category"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["product_category"]) {
                // line 381
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div id=\"product-category";
                echo $context["product_category"];
                echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                echo $context["key"];
                echo " 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 382
                if (($context["module_purpletree_multivendor_allow_categorytype"] ?? null)) {
                    echo " ";
                } else {
                    // line 383
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"module_purpletree_multivendor_allow_category[]\" value=\"";
                    echo $context["product_category"];
                    echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 385
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['product_category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 387
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 388
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div> 
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!-- product category -->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-seller_product_category\">";
        // line 395
        echo ($context["entry_seller_product_category"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_product_category\" class=\"form-select\" id=\"input-seller_product_category\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 398
        if (($context["module_purpletree_multivendor_seller_product_category"] ?? null)) {
            // line 399
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            // line 400
            echo ($context["text_multiple"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 401
            echo ($context["text_single"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 403
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_multiple"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 404
            echo ($context["text_single"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 406
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!-- product category -->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-seller-login\">";
        // line 413
        echo ($context["entry_seller_login"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_login\" class=\"form-select\" id=\"input-seller-login\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 416
        if (($context["module_purpletree_multivendor_seller_login"] ?? null)) {
            // line 417
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 418
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 420
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 421
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 423
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 429
        echo ($context["entry_allow_live_chat"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_allow_live_chat\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 432
        if (($context["module_purpletree_multivendor_allow_live_chat"] ?? null)) {
            // line 433
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 434
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 436
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 437
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 439
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!-- my div -->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 446
        echo ($context["allow_browse_sellers"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_browse_sellers\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 449
        if (($context["module_purpletree_multivendor_browse_sellers"] ?? null)) {
            // line 450
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 451
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 453
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 454
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 455
        echo "\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t<!--Hide user menu-->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-hide-user-menu\">";
        // line 462
        echo ($context["text_hide_user_menu"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_hide_user_menu\" class=\"form-select\" id=\"input-hide-user-menu\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 465
        if (($context["module_purpletree_multivendor_hide_user_menu"] ?? null)) {
            // line 466
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 467
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 469
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 470
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 471
        echo "\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t<!--End Hide user menu--> 
\t\t\t\t\t\t\t\t\t\t<!--Start domain wise store--> 
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-hide-user-menu\">";
        // line 479
        echo ($context["text_multiple_store"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_multi_store\" class=\"form-select\" id=\"input-hide-user-menu\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 482
        if (($context["module_purpletree_multivendor_multi_store"] ?? null)) {
            // line 483
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 484
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 486
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 487
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 488
        echo "\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t<!--End domain wise store--> 
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
            </div>
            <div id=\"tab-seller\" class=\"tab-pane\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<h3>";
        // line 502
        echo ($context["seller_product_heading"] ?? null);
        echo "</h3>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!-- Start Quick order -->
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-seller_info_success\">";
        // line 506
        echo ($context["entry_seller_info_success"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select id = \"input-seller_info_success\" name=\"module_purpletree_multivendor_seller_info_on_order_sucess\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 509
        if (($context["module_purpletree_multivendor_seller_info_on_order_sucess"] ?? null)) {
            // line 510
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 511
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 513
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 514
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 516
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t <div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input_seller_name\">";
        // line 522
        echo ($context["entry_show_seller_name"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_show_seller_name\" class=\"form-select\" id=\"input_seller_name\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 525
        if (($context["module_purpletree_multivendor_show_seller_name"] ?? null)) {
            // line 526
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 527
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 529
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 530
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 532
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input_seller_address\">";
        // line 538
        echo ($context["entry_show_seller_address"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_show_seller_address\" class=\"form-select\" id=\"input_seller_address\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 541
        if (($context["module_purpletree_multivendor_show_seller_address"] ?? null)) {
            // line 542
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 543
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 545
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 546
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 548
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t<!-- End Quick order -->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input_hide_seller\">";
        // line 555
        echo ($context["entry_hide_seller_detail"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_hide_seller_detail\" class=\"form-select\" id=\"input_hide_seller\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 558
        if (($context["module_purpletree_multivendor_hide_seller_detail"] ?? null)) {
            // line 559
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 560
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 562
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 563
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 565
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-seller-login\">";
        // line 571
        echo ($context["entry_allowseller_oncategory"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_allow_selleron_category\" class=\"form-select\" id=\"input-seller-login\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 574
        if ((($context["module_purpletree_multivendor_allow_selleron_category"] ?? null) == "service_mode")) {
            // line 575
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_normal_mode"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 576
            echo ($context["text_category_mode"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"service_mode\" selected=\"selected\">";
            // line 577
            echo ($context["text_service_mode"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } elseif ((        // line 578
($context["module_purpletree_multivendor_allow_selleron_category"] ?? null) == "1")) {
            // line 579
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_normal_mode"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 580
            echo ($context["text_category_mode"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"service_mode\">";
            // line 581
            echo ($context["text_service_mode"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 583
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_normal_mode"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 584
            echo ($context["text_category_mode"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"service_mode\">";
            // line 585
            echo ($context["text_service_mode"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 587
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-seller-login\">";
        // line 593
        echo ($context["entry_allowtemplate_description"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_template_description\" class=\"form-select\" id=\"input-seller-login\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 596
        if (($context["module_purpletree_multivendor_template_description"] ?? null)) {
            // line 597
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 598
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 600
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 601
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 603
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" >";
        // line 609
        echo ($context["entry_temp_prod_price_list"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_temp_prod_price_list\" class=\"form-select\" id=\"input-seller-login\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 612
        if (($context["module_purpletree_multivendor_temp_prod_price_list"] ?? null)) {
            // line 613
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 614
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 616
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 617
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 619
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-seller-login\">";
        // line 625
        echo ($context["entry_storepage_layout"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_storepage_layout\" class=\"form-select\" id=\"input-seller-login\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 628
        if (($context["module_purpletree_multivendor_storepage_layout"] ?? null)) {
            // line 629
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_layout_one"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 630
            echo ($context["text_layout_two"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 632
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_layout_one"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 633
            echo ($context["text_layout_two"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 635
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!-- seller product view -->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-products-view\">";
        // line 642
        echo ($context["entry_products_view"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_products_view\" class=\"form-select\" id=\"input-products-view\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 645
        if (($context["module_purpletree_multivendor_products_view"] ?? null)) {
            // line 646
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_list"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 647
            echo ($context["text_grid"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 649
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_list"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 650
            echo ($context["text_grid"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 652
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!--End seller product view-->
\t\t\t\t\t\t\t\t\t\t<!--Hide Seller Product Tabs-->
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-hide-product_tab\">";
        // line 660
        echo ($context["text_hide_seller_product_tab"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_hide_seller_product_tab\" class=\"form-select\" id=\"input-hide-product_tab\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 663
        if (($context["module_purpletree_multivendor_hide_seller_product_tab"] ?? null)) {
            // line 664
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 665
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 667
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 668
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 669
        echo "\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label \" for=\"input-hide-user-menu\">";
        // line 676
        echo ($context["text_allow_seller_to_reply_customer"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_allow_seller_to_reply\" class=\"form-select\" id=\"input-hide-user-menu\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 679
        if (($context["module_purpletree_multivendor_allow_seller_to_reply"] ?? null)) {
            // line 680
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 681
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 683
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 684
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 685
        echo "\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div> \t\t\t\t\t 
\t\t\t\t\t\t\t\t\t\t<!-- End Hide Seller Product Tabs--> 
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-product-template\">";
        // line 693
        echo ($context["text_seller_product_template"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_product_template\" class=\"form-select\" id=\"input-product-template\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 696
        if (($context["module_purpletree_multivendor_seller_product_template"] ?? null)) {
            // line 697
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 698
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 700
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 701
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 702
        echo "\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 709
        echo ($context["entry_allow_related"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_allow_related_product\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 712
        if (($context["module_purpletree_multivendor_allow_related_product"] ?? null)) {
            // line 713
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 714
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 716
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 717
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 719
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!-- End Hide freatured edit button--> 
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 726
        echo ($context["entry_featured_enabled_hide_edit"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_featured_enabled_hide_edit\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 729
        if (($context["module_purpletree_multivendor_featured_enabled_hide_edit"] ?? null)) {
            // line 730
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 731
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 733
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 734
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 736
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 742
        echo ($context["entry_seller_featured_product"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_featured_products\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 745
        if (($context["module_purpletree_multivendor_seller_featured_products"] ?? null)) {
            // line 746
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 747
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 749
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 750
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 752
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 758
        echo ($context["entry_seller_category_featured_product"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_category_featured\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 761
        if (($context["module_purpletree_multivendor_seller_category_featured"] ?? null)) {
            // line 762
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 763
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 765
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 766
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 768
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 774
        echo ($context["entry_limit_purchase"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"module_purpletree_multivendor_product_limit\" class=\"form-control\" value=\"";
        // line 776
        echo ((array_key_exists("module_purpletree_multivendor_product_limit", $context)) ? (($context["module_purpletree_multivendor_product_limit"] ?? null)) : (""));
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 777
        if (($context["product_limit_error"] ?? null)) {
            // line 778
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["product_limit_error"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 780
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<h3>";
        // line 791
        echo ($context["seller_review_heading"] ?? null);
        echo "</h3>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 795
        echo ($context["entry_seller_review"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_review\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 798
        if (($context["module_purpletree_multivendor_seller_review"] ?? null)) {
            // line 799
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 800
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 802
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 803
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 805
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<h3>";
        // line 817
        echo ($context["seller_contact_heading"] ?? null);
        echo "</h3>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 821
        echo ($context["entry_seller_contact"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_contact\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 824
        if (($context["module_purpletree_multivendor_seller_contact"] ?? null)) {
            // line 825
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_seller_general"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 826
            echo ($context["text_seller_logedin"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 828
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_seller_general"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 829
            echo ($context["text_seller_logedin"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 831
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!----- Start seller Blog setting ---------->
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<h3>";
        // line 843
        echo ($context["seller_blog_heading"] ?? null);
        echo "</h3>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-blog\">";
        // line 847
        echo ($context["entry_seller_sort_by"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_blog_order\" class=\"form-select\" id = \"input-blog\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 850
        if (($context["module_purpletree_multivendor_seller_blog_order"] ?? null)) {
            // line 851
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_sort_order"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 852
            echo ($context["text_create_date_order"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 854
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_sort_order"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 855
            echo ($context["text_create_date_order"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 857
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!----- End seller Blog setting ---------->
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<h3>";
        // line 869
        echo ($context["seller_store_heading"] ?? null);
        echo "</h3>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 row\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 873
        echo ($context["entry_seller_store"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9 py-2\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"checkbox-inline\"><input type=\"checkbox\" class=\"form-check-input\" value=\"1\" name=\"module_purpletree_multivendor_seller_name\" ";
        // line 875
        echo ((($context["module_purpletree_multivendor_seller_name"] ?? null)) ? ("checked=\"checked\"") : (""));
        echo " > ";
        echo ($context["text_store_seller_name"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"checkbox-inline\"><input type=\"checkbox\" class=\"form-check-input\" value=\"1\" name=\"module_purpletree_multivendor_store_email\" ";
        // line 876
        echo ((($context["module_purpletree_multivendor_store_email"] ?? null)) ? ("checked=\"checked\"") : (""));
        echo " > ";
        echo ($context["text_store_email"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"checkbox-inline\"><input type=\"checkbox\" class=\"form-check-input\" value=\"1\" name=\"module_purpletree_multivendor_store_phone\" ";
        // line 878
        echo ((($context["module_purpletree_multivendor_store_phone"] ?? null)) ? ("checked=\"checked\"") : (""));
        echo " > ";
        echo ($context["text_store_phone"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"checkbox-inline\"><input type=\"checkbox\" class=\"form-check-input\" value=\"1\" name=\"module_purpletree_multivendor_store_address\" ";
        // line 880
        echo ((($context["module_purpletree_multivendor_store_address"] ?? null)) ? ("checked=\"checked\"") : (""));
        echo " > ";
        echo ($context["text_store_address"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<!-- /////    Store social link   ////// -->
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"checkbox-inline\"><input type=\"checkbox\" value=\"1\" name=\"module_purpletree_multivendor_store_social_link\" ";
        // line 882
        echo ((($context["module_purpletree_multivendor_store_social_link"] ?? null)) ? ("checked=\"checked\"") : (""));
        echo "  class=\"form-check-input\" > ";
        echo ($context["text_store_social_link"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<!--  ////  Store social link end ////// -->
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t<!-- Hide customer detail -->
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 row\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 890
        echo ($context["entry_seller_invoice"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_seller_invoice\" class=\"form-select\" id=\"hide-customer-detail\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 893
        if (($context["module_purpletree_multivendor_seller_invoice"] ?? null)) {
            // line 894
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 895
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 897
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option  value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 898
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 900
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t<div class=\"col-sm-12 text-left pts-hide-customer-detail\">
\t\t\t\t\t\t\t\t<label class=\"checkbox-inline\" style=\"padding-top:15px; padding-left:5px\" for=\"pts-hide-customer-detail\" >\t\t\t\t\t\t\t\t\t<input id=\"pts-hide-customer-detail\" type=\"checkbox\" value=\"1\" name=\"module_purpletree_multivendor_hide_customer_details\" ";
        // line 902
        echo ((($context["module_purpletree_multivendor_hide_customer_details"] ?? null)) ? ("checked=\"checked\"") : (""));
        echo " class=\"form-check-input\" >
";
        // line 903
        echo ($context["entry_hide_customer_detail"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<!--<div class=\"radio\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label><input type=\"radio\" name=\"module_purpletree_multivendor_seller_invoice\" value=\"1\" checked>&nbsp;";
        // line 906
        echo ($context["text_yes"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t<label><input type=\"radio\" name=\"module_purpletree_multivendor_seller_invoice\" ";
        // line 907
        echo (((($context["module_purpletree_multivendor_seller_invoice"] ?? null) == "0")) ? ("checked") : (""));
        echo " value=\"0\">&nbsp;";
        echo ($context["text_no"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t</div>-->
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- Hide customer detail -->\t\t\t\t
<!-- Seller account terms -->
\t<div class=\"col-sm-12\">
\t\t<div class=\"form-group py-1 row\">
\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"seller-account-terms\">";
        // line 916
        echo ($context["text_seller_ac_terms"] ?? null);
        echo "</label>
\t\t\t<div class=\"col-md-9\">
\t\t\t\t<select name=\"module_purpletree_multivendor_seller_ac_terms\" id=\"seller-account-terms\" class=\"form-select\">
\t\t\t\t  <option value=\"0\">";
        // line 919
        echo ($context["text_none"] ?? null);
        echo "</option>                      
\t\t\t\t  ";
        // line 920
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
            // line 921
            echo "\t\t\t\t  ";
            if ((twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 921) == ($context["module_purpletree_multivendor_seller_ac_terms"] ?? null))) {
                echo "                      
\t\t\t\t  <option value=\"";
                // line 922
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 922);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 922);
                echo "</option>                      
\t\t\t\t  ";
            } else {
                // line 923
                echo "                      
\t\t\t\t  <option value=\"";
                // line 924
                echo twig_get_attribute($this->env, $this->source, $context["information"], "information_id", [], "any", false, false, false, 924);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 924);
                echo "</option>                      
\t\t\t\t  ";
            }
            // line 926
            echo "\t\t\t\t  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "                    
\t\t\t\t</select>
\t\t\t  </div>
\t\t</div>
\t</div>
<!-- Seller account terms -->
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
            </div>
            <div id=\"tab-subscription\" class=\"tab-pane\">
\t\t\t\t\t\t<!----- Subcription plan---------->
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<h3>";
        // line 942
        echo ($context["heading_subscription_plan"] ?? null);
        echo "</h3>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-enable_subscription\">";
        // line 946
        echo ($context["enable_subscription_plans_txt"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_subscription_plans\" class=\"form-select subscriptionchange\" id=\"input-enable_subscription\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 949
        if (($context["module_purpletree_multivendor_subscription_plans"] ?? null)) {
            // line 950
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 951
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 953
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 954
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 956
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"subscription ";
        // line 960
        if (($context["module_purpletree_multivendor_subscription_plans"] ?? null)) {
            echo " ";
        } else {
            echo " ptsc-storefrm-nodisplay ";
        }
        echo "\" >
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 963
        echo ($context["enable_subscription_price_txt"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_subscription_price\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 966
        if (($context["module_purpletree_multivendor_subscription_price"] ?? null)) {
            // line 967
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 968
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 970
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 971
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 973
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 979
        echo ($context["enable_joining_fees_txt"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_joining_fees\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 982
        if (($context["module_purpletree_multivendor_joining_fees"] ?? null)) {
            // line 983
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 984
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 986
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 987
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 989
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 995
        echo ($context["paypal_hosted_button_id"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 997
        echo ($context["paypal_hosted_button_id"] ?? null);
        echo "\" name=\"module_purpletree_multivendor_paypal_email\" class=\"form-control\" value=\"";
        echo ($context["module_purpletree_multivendor_paypal_email"] ?? null);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 998
        if (($context["error_paypal_email"] ?? null)) {
            // line 999
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["error_paypal_email"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1001
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1006
        echo ($context["tax_name_txt"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 1008
        echo ($context["tax_name_txt"] ?? null);
        echo "\" name=\"module_purpletree_multivendor_tax_name\" class=\"form-control\" value=\"";
        echo ($context["module_purpletree_multivendor_tax_name"] ?? null);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1009
        if (($context["tax_name_error"] ?? null)) {
            // line 1010
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["tax_name_error"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1012
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1017
        echo ($context["tax_value_txt"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 1019
        echo ($context["tax_value_txt"] ?? null);
        echo "\" name=\"module_purpletree_multivendor_tax_value\" class=\"form-control\" value=\"";
        echo ($context["module_purpletree_multivendor_tax_value"] ?? null);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1020
        if (($context["tax_value_error"] ?? null)) {
            // line 1021
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["tax_value_error"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1023
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1028
        echo ($context["reminder_one_days_before_to_be_sent_txt"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 1030
        echo ($context["reminder_one_days_before_to_be_sent_txt"] ?? null);
        echo "\" name=\"module_purpletree_multivendor_reminder_one_days\" class=\"form-control\" value=\"";
        echo ($context["module_purpletree_multivendor_reminder_one_days"] ?? null);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1031
        if (($context["error_reminder_one_days"] ?? null)) {
            // line 1032
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["error_reminder_one_days"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1034
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1039
        echo ($context["reminder_two_days_before_to_be_sent_txt"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 1041
        echo ($context["reminder_two_days_before_to_be_sent_txt"] ?? null);
        echo "\" name=\"module_purpletree_multivendor_reminder_two_days\" class=\"form-control\" value=\"";
        echo ($context["module_purpletree_multivendor_reminder_two_days"] ?? null);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1042
        if (($context["error_reminder_two_days"] ?? null)) {
            // line 1043
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["error_reminder_two_days"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1045
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1050
        echo ($context["reminder_three_days_before_to_be_sent_txt"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 1052
        echo ($context["reminder_three_days_before_to_be_sent_txt"] ?? null);
        echo "\"  name=\"module_purpletree_multivendor_reminder_three_days\" class=\"form-control\" value=\"";
        echo ($context["module_purpletree_multivendor_reminder_three_days"] ?? null);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1053
        if (($context["error_reminder_three_days"] ?? null)) {
            // line 1054
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["error_reminder_three_days"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1056
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1061
        echo ($context["grace_period_txt"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 1063
        echo ($context["reminder_three_days_before_to_be_sent_txt"] ?? null);
        echo "\" name=\"module_purpletree_multivendor_grace_period\" class=\"form-control\" value=\"";
        echo ($context["module_purpletree_multivendor_grace_period"] ?? null);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1064
        if (($context["error_grace_period"] ?? null)) {
            // line 1065
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["error_grace_period"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1067
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1072
        echo ($context["enable_multiple_active_plan"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_multiple_subscription_plan_active\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1075
        if (($context["module_purpletree_multivendor_multiple_subscription_plan_active"] ?? null)) {
            // line 1076
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 1077
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 1079
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 1080
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1082
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group row py-1\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1088
        echo ($context["text_default_currency_paypal"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_paypal_currency\" id=\"input-currency\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1091
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["paypalcurrencies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["currencies"]) {
            echo " 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 1092
            if ((twig_get_attribute($this->env, $this->source, $context["currencies"], "code", [], "any", false, false, false, 1092) == ($context["module_purpletree_multivendor_paypal_currency"] ?? null))) {
                echo " 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                // line 1093
                echo twig_get_attribute($this->env, $this->source, $context["currencies"], "code", [], "any", false, false, false, 1093);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["currencies"], "title", [], "any", false, false, false, 1093);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
            } else {
                // line 1094
                echo " 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                // line 1095
                echo twig_get_attribute($this->env, $this->source, $context["currencies"], "code", [], "any", false, false, false, 1095);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["currencies"], "title", [], "any", false, false, false, 1095);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 1096
            echo " 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currencies'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1097
        echo " 
\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!----end subscription plan---------->
            </div>
            <div id=\"tab-development\" class=\"tab-pane\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<h3>";
        // line 1113
        echo ($context["heading_development_Option"] ?? null);
        echo "</h3>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-jquery\">
\t\t\t\t\t\t\t\t\t\t\t";
        // line 1118
        echo ($context["enable_include_jquery"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_include_jquery\" class=\"form-select\" id=\"input-jquery\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1121
        if ((($context["module_purpletree_multivendor_include_jquery"] ?? null) == 1)) {
            // line 1122
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            // line 1123
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 1125
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            // line 1126
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1128
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>\t
            </div>
              <div id=\"tab-hyperlocal\" class=\"tab-pane\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t   <!--Start Hyper Local -->              
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1141
        echo ($context["entry_seller_areaheading"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_hyperlocal_status\" class=\"form-select HyperLocalchange\" id=\"input-customer_manage_order\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1144
        if (($context["module_purpletree_multivendor_hyperlocal_status"] ?? null)) {
            // line 1145
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 1146
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 1148
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 1149
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1151
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"HypeLocal ";
        // line 1155
        if (($context["module_purpletree_multivendor_hyperlocal_status"] ?? null)) {
            echo " ";
        } else {
            echo " ptsc-storefrm-nodisplay ";
        }
        echo "\">
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1158
        echo ($context["entry_header_popup"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 1160
        echo ($context["entry_header_popup"] ?? null);
        echo "\" name=\"module_purpletree_multivendor_hp_heading\" class=\"form-control\" value=\"";
        echo ($context["module_purpletree_multivendor_hp_heading"] ?? null);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1161
        if (($context["tax_name_error"] ?? null)) {
            // line 1162
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"text-danger\">";
            echo ($context["tax_name_error"] ?? null);
            echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1164
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1171
        echo ($context["entry_hyperlocal_select_type"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_hyperlocal_type\" class=\"form-select\" id=\"input-hyperlocal-type\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1174
        if (($context["module_purpletree_multivendor_hyperlocal_type"] ?? null)) {
            // line 1175
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" ";
            if ((($context["module_purpletree_multivendor_hyperlocal_type"] ?? null) == 0)) {
                echo "selected=\"selected\" ";
            }
            echo ">";
            echo ($context["entry_hyperlocal_select_area"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" ";
            // line 1176
            if ((($context["module_purpletree_multivendor_hyperlocal_type"] ?? null) == 1)) {
                echo "selected=\"selected\" ";
            }
            echo ">";
            echo ($context["entry_hyperlocal_search_area"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"2\" ";
            // line 1177
            if ((($context["module_purpletree_multivendor_hyperlocal_type"] ?? null) == 2)) {
                echo "selected=\"selected\" ";
            }
            echo ">";
            echo ($context["entry_hyperlocal_text_box"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 1179
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" >";
            echo ($context["entry_hyperlocal_select_area"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 1180
            echo ($context["entry_hyperlocal_search_area"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"2\" >";
            // line 1181
            echo ($context["entry_hyperlocal_text_box"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1183
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-area_selection\">";
        // line 1189
        echo ($context["entry_area_selection"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_area_status\" class=\"form-select\" id=\"input-area_selection\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1192
        if (($context["module_purpletree_multivendor_area_status"] ?? null)) {
            // line 1193
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 1194
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 1196
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 1197
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1199
        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12 col-sm-offset-2 offset-md-2\">\t\t\t\t\t   
\t\t\t\t\t\t\t\t\t\t  
\t\t\t\t\t\t\t\t\t\t     <a href=\"";
        // line 1206
        echo ($context["seller_area_link"] ?? null);
        echo "\" class=\"btn btn-primary ptsc-mv-sellarealink\">";
        echo ($context["entry_seller_area_link"] ?? null);
        echo "</a>
\t\t\t\t\t\t\t\t\t\t   
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<!--end Hyper Local -->\t
\t\t\t\t\t\t</div>\t
              </div>

            <div id=\"tab-other\" class=\"tab-pane\">
\t\t\t\t\t\t\t\t<!----Start development option---------->
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<h3>";
        // line 1219
        echo ($context["text_other_settings"] ?? null);
        echo "</h3>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group py-1 required row\">
\t\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 control-label col-form-label\" for=\"input-name\">";
        // line 1223
        echo ($context["entry_allow_metals"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">
\t\t\t\t\t\t\t\t\t\t\t\t<select name=\"module_purpletree_multivendor_allow_metals_product\" class=\"form-select\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        // line 1226
        if (($context["module_purpletree_multivendor_allow_metals_product"] ?? null)) {
            // line 1227
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            // line 1228
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        } else {
            // line 1230
            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_no"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"1\">";
            // line 1231
            echo ($context["text_yes"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }
        // line 1233
        echo "\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>\t
\t\t\t</div>
            <div id=\"tab-seller-reg\" class=\"tab-pane\">
\t\t\t\t\t<div class=\"row\">
\t\t\t<div class=\"col-sm-12\">
\t\t\t\t<div class=\"clearfix\">
\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t<h3>";
        // line 1246
        echo ($context["text_hide_seller_reg_field"] ?? null);
        echo "</h3>
\t\t\t\t\t</div>
<div class=\"col-sm-12\">
\t\t\t\t\t";
        // line 1249
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["seller_reg_fields"] ?? null));
        foreach ($context['_seq'] as $context["field"] => $context["seller_reg_data"]) {
            // line 1250
            echo "\t\t\t\t<div class=\"col-sm-12\">\t
\t\t\t\t\t<h4>
\t\t\t\t\t\t";
            // line 1252
            if (($context["field"] == "personal_details")) {
                // line 1253
                echo "\t\t\t\t\t\t\t";
                echo ($context["personal_details"] ?? null);
                echo "
\t\t\t\t\t\t";
            }
            // line 1255
            echo "\t\t\t\t\t\t";
            if (($context["field"] == "seller_information")) {
                // line 1256
                echo "\t\t\t\t\t\t\t";
                echo ($context["seller_information"] ?? null);
                echo "
\t\t\t\t\t\t";
            }
            // line 1258
            echo "\t\t\t\t\t\t";
            if (($context["field"] == "payment_details")) {
                // line 1259
                echo "\t\t\t\t\t\t\t";
                echo ($context["payment_details"] ?? null);
                echo "
\t\t\t\t\t\t";
            }
            // line 1261
            echo "\t\t\t\t\t</h4>
\t\t\t\t</div>
\t\t\t\t\t";
            // line 1263
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["seller_reg_data"]);
            foreach ($context['_seq'] as $context["key"] => $context["seller_reg_field"]) {
                // line 1264
                echo "\t\t\t\t\t<div class=\"col-sm-12 mb-2\">\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<div class=\"col-md-9 offset-md-3\" for=\"input-name\">
\t\t\t\t\t\t\t<label class=\"checkbox-inline\" for=\"reg-field-name-";
                // line 1266
                echo $context["field"];
                echo $context["key"];
                echo "\">
\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"module_purpletree_multivendor_hide_reg[]\" id=\"reg-field-name-";
                // line 1267
                echo $context["field"];
                echo $context["key"];
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, $context["seller_reg_field"], "field_required", [], "any", false, false, false, 1267)) {
                    echo " disabled=\"disabled\" ";
                }
                echo " value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["seller_reg_field"], "field_name", [], "any", false, false, false, 1267);
                echo "\" ";
                if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["seller_reg_field"], "field_name", [], "any", false, false, false, 1267), ($context["module_purpletree_multivendor_hide_reg"] ?? null))) {
                    echo " checked=\"checked\" ";
                }
                echo " class=\"form-check-input\"><span style=\"margin-left: 10px;\">";
                echo twig_get_attribute($this->env, $this->source, $context["seller_reg_field"], "field_title", [], "any", false, false, false, 1267);
                echo "</span></label></div>
\t\t\t\t\t</div>
\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['seller_reg_field'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1270
            echo "\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['field'], $context['seller_reg_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1271
        echo "\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>\t
            </div>

          </div>
          <input type=\"hidden\" name=\"product_id\" value=\"";
        // line 1278
        echo ($context["product_id"] ?? null);
        echo "\" id=\"input-product-id\"/>
        </form>
\t\t<div class=\"panel-footer card-footer text-center ptsc-mv-version\">";
        // line 1280
        echo ($context["version"] ?? null);
        echo "
\t\t\t</div>
\t\t
      </div>
    </div>
  </div>
</div>
<script type=\"text/javascript\">
\$(document).ready(function(){ 
\t\tvar allowedCat = '";
        // line 1289
        echo ($context["module_purpletree_multivendor_allow_categorytype"] ?? null);
        echo "';
\t\t
\t\tif(!allowedCat){
\t\t\t\$('select[name=\"module_purpletree_multivendor_allow_categorytype\"]').val(1);
\t\t\t\$('#input-category').prop('disabled', true);
\t\t\t
\t\t\t\$('#product-category').empty();
\t\t\t\$.ajax({
\t\t\t\turl:'index.php?route=extension/purpletree_multivendor/multivendor/sellerproducts|assignCategory&user_token=";
        // line 1297
        echo ($context["user_token"] ?? null);
        echo "&filter_name=',
\t\t\t\tdataType: 'json',
\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\$.map(json, function(item) {
\t\t\t\t\t\t\$('#product-category').append('<div id=\"product-category' + item['category_id'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['name'] + '<input type=\"hidden\" name=\"module_purpletree_multivendor_allow_category[]\" value=\"' + item['category_id'] + '\" /></div>');
\t\t\t\t\t});
\t\t\t\t}
\t\t\t});
\t\t}
\t});
\t\$('.subscriptionchange').on('change', function(){
\t\tvar selectid = \$(this).val();
\t\tif(selectid == \"1\") {
\t\t\t\$('.subscription').css('display','block');
\t\t\t} else {
\t\t\t\$('.subscription').css('display','none');
\t\t}
\t})
\t\$('select[name=\"module_purpletree_multivendor_allow_categorytype\"]').on('change', function(){
\t\tvar selectid = \$(this).val();
\t\tif(selectid==\"1\"){
\t\t\t\$('#input-category').prop('disabled', true);
\t\t\t
\t\t\t\$('#product-category').empty();
\t\t\t\$.ajax({
\t\t\t\turl:'index.php?route=extension/purpletree_multivendor/multivendor/sellerproducts|assignCategory&user_token=";
        // line 1322
        echo ($context["user_token"] ?? null);
        echo "&filter_name=',
\t\t\t\tdataType: 'json',
\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\$.map(json, function(item) {
\t\t\t\t\t\t\$('#product-category').append('<div id=\"product-category' + item['category_id'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['name'] + '</div>');
\t\t\t\t\t});
\t\t\t\t}
\t\t\t});
\t\t\t
\t\t\t} else{
\t\t\t\$('#input-category').prop('disabled', false);
\t\t\t\$('#product-category').empty();
\t\t\t\$.ajax({
\t\t\t\turl:'index.php?route=extension/module/purpletree_multivendor/multivendor/getSelectedCategory&user_token=";
        // line 1335
        echo ($context["user_token"] ?? null);
        echo "&filter_name=',
\t\t\t\tdataType: 'json',
\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\$.map(json, function(item) {
\t\t\t\t\t\t\$('#product-category').append('<div id=\"product-category' + item['category_id'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['name'] + '<input type=\"hidden\" name=\"module_purpletree_multivendor_allow_category[]\" value=\"' + item['category_id'] + '\" /></div>');
\t\t\t\t\t});
\t\t\t\t}
\t\t\t});
\t\t}
\t});
\t\$('input[name=\\'category\\']').autocomplete({
\t\t'source': function(request, response) {
\t\t\t\$.ajax({
\t\t\t\turl:'index.php?route=catalog/category|autocomplete&user_token=";
        // line 1348
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\t\tdataType: 'json',
\t\t\t\tsuccess: function(json) {
\t\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\t\treturn {
\t\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\t\tvalue: item['category_id']
\t\t\t\t\t\t}
\t\t\t\t\t}));
\t\t\t\t}
\t\t\t});
\t\t},
\t\t'select': function(item) {
\t\t\t\$('input[name=\\'category\\']').val('');
\t\t\t
\t\t\t\$('#product-category' + item['value']).remove();
\t\t\t
\t\t\t\$('#product-category').append('<div id=\"product-category' + item['value'] + '\"><i class=\"fa fa-minus-circle\"></i> ' + item['label'] + '<input type=\"hidden\" name=\"module_purpletree_multivendor_allow_category[]\" value=\"' + item['value'] + '\" /></div>');
\t\t}
\t});
\t
\t\$('#product-category').delegate('.fa-minus-circle', 'click', function() {
\t\t
\t\tvar cat_id = \$(this).next().val();
\t\tvar div_remov = \$(this).parent();
\t\t\$.ajax({
\t\t\turl:'index.php?route=extension/purpletree_multivendor/multivendor/sellerproducts/checkCategoryassign&user_token=";
        // line 1374
        echo ($context["user_token"] ?? null);
        echo "&filter_name='+cat_id,
\t\t\ttype: 'GET',
\t\t\tsuccess: function(result) {
\t\t\t\tif(result > 0){
\t\t\t\t\talert(\"";
        // line 1378
        echo ($context["text_assign_categories"] ?? null);
        echo "\");
\t\t\t\t\t} else{ 
\t\t\t\t\tdiv_remov.remove();
\t\t\t\t}
\t\t\t}
\t\t});
\t});
\t
</script>
<style>\t
\t<!-- body {font-family: Arial, Helvetica, sans-serif;} -->
\tbody {font-family: Arial, Helvetica, sans-serif;}\t\t
</style>
<script>
\tvar modal = document.getElementById('licenseModal');
\tvar btn = document.getElementById(\"getLicensee\");
\tvar span = document.getElementsByClassName(\"close\")[0];
\tbtn.onclick = function() {
\t\tmodal.style.display = \"block\";
\t\t// \$('#modal_lic_error').html('');
\t\t\$('#modal_lic_error').css('display','none');
\t}
\tspan.onclick = function() {
\t\tmodal.style.display = \"none\";
\t\t\$('.orderdiv').css('display','none');
\t}
\t
\t
\twindow.onclick = function(event) {
\t\tif (event.target == modal) {
\t\t\tmodal.style.display = \"none\";
\t\t}
\t}
</script>
<script>
\tfunction savelicc(){
\t\tvar licenskey1 = \$('#licenskey1').val();
\t\tif (licenskey1 == \"\") {
\t\t\t\$('#modal_lic_error').html(\"";
        // line 1416
        echo ($context["error_Enter_license_key"] ?? null);
        echo "\");
\t\t\t\$('#modal_lic_error').css('display','block');
\t\t\t\$('.alertseucess').css('display','none');
\t\t\t} else {
\t\t\t\$('.alertseucess').text(\"";
        // line 1420
        echo ($context["text_license_key_changed"] ?? null);
        echo "\");
\t\t\t\$('.alertseucess').css('display','block');
\t\t\t\$('#setlicensee').val(licenskey1);
\t\t\t\$('.orderdiv').css('display','none');
\t\t\t\$('.close').click();
\t\t}
\t}
\tfunction dontlice(){
\t\t\$('.orderdiv').css('display','block');
\t}
\tfunction getlicense(order_id,Email_id){
\t\t\$('.getlicbtn').addClass('disabled');
\t\t\$('.getlicbtn').val(\"";
        // line 1432
        echo ($context["please_wait"] ?? null);
        echo "\");
\t\tvar order_id = document.getElementById('order_id').value;
\t\tvar email_id = document.getElementById('email_id').value;
\t\tif (!order_id.match(/^\\d+/)) {
\t\t\t\$('#modal_lic_error').html(\"";
        // line 1436
        echo ($context["error_order_id"] ?? null);
        echo "\");
\t\t\t\$('#modal_lic_error').css('display','block');
\t\t\t\$('.getlicbtn').removeClass('disabled');
\t\t\t\$('.getlicbtn').val(\"";
        // line 1439
        echo ($context["button_submit"] ?? null);
        echo "\");
\t\t\treturn false;
\t\t} 
\t\tvar atpos = email_id.indexOf(\"@\");
\t\tvar dotpos = email_id.lastIndexOf(\".\");
\t\tif (atpos<1 || dotpos<atpos+2 || dotpos+2>=email_id.length) {
\t\t\t\$('#modal_lic_error').html(\"";
        // line 1445
        echo ($context["error_email_id"] ?? null);
        echo "\");
\t\t\t\$('#modal_lic_error').css('display','block');
\t\t\t\$('.getlicbtn').removeClass('disabled');
\t\t\t\$('.getlicbtn').val(\"";
        // line 1448
        echo ($context["button_submit"] ?? null);
        echo "\")
\t\t\treturn false;
\t\t}
\t\t\$.ajax ({
            url: \"https://process.purpletreesoftware.com/processorder.php\",
            data:'order_id='+order_id+'&email_id='+email_id+'&module=purpletree_multivendor_oc',
\t\t\ttype: 'POST',
\t\t\tdataType: \"json\",
            success: function( result ) {
\t\t\t\t\$('.getlicbtn').removeClass('disabled');
\t\t\t\t\$('.getlicbtn').val(\"";
        // line 1458
        echo ($context["button_submit"] ?? null);
        echo "\")
\t\t\t\tif(result.status == 'success') {
\t\t\t\t\t\$('.alertseucess').text(\"";
        // line 1460
        echo ($context["text_license_key_changed"] ?? null);
        echo "\");
\t\t\t\t\t\$('.alertseucess').css('display','block');
\t\t\t\t\t\$('#setlicensee').val(result.process_data);
\t\t\t\t\t\$('.orderdiv').css('display','none');
\t\t\t\t\t\$('.close').click();
\t\t\t\t\t} else {
\t\t\t\t\t\$('#modal_lic_error').html(result.msg);
\t\t\t\t\t\$('#modal_lic_error').css('display','block');
\t\t\t\t}
\t\t\t}
\t\t});
\t}
\t
\t\$('.HyperLocalchange').on('change', function(){
\t\tvar selectid = \$(this).val();
\t\tif(selectid == \"1\") {
\t\t\t\$('.HypeLocal').css('display','block');
\t\t\t} else {
\t\t\t\$('.HypeLocal').css('display','none');
\t\t}
\t})
\t
\t\t\$( \"#hide-customer-detail\" ).change(function(e) {
\t\t\tvar selectid = \$(this).val();
\t\tif(selectid == \"0\") {
\t\t\t\t\$(\".pts-hide-customer-detail\" ).css( \"display\",\"block\" );
\t\t\t} else {
\t\t\t\t\$(\".pts-hide-customer-detail\" ).css( \"display\",\"none\" );
\t\t\t}
\t\t}).change();
\t\t
// Category
// \$('#input-category').autocomplete({
    // 'source': function (request, response) {
        // \$.ajax({
            // url: 'index.php?route=catalog/category|autocomplete&user_token=";
        // line 1495
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' + encodeURIComponent(request),
            // dataType: 'json',
            // success: function (json) {
                // response(\$.map(json, function (item) {
                    // return {
                        // label: item['name'],
                        // value: item['category_id']
                    // }
                // }));
            // }
        // });
    // },
    // 'select': function (item) {
        // \$('#input-category').val('');

        // \$('#product-category-' + item['value']).remove();

        // html = '<tr id=\"product-category-' + item['value'] + '\">';
        // html += '  <td>' + item['label'] + '<input type=\"hidden\" name=\"product_category[]\" value=\"' + item['value'] + '\"/></td>';
        // html += '  <td class=\"text-end\"><button type=\"button\" class=\"btn btn-danger btn-sm\"><i class=\"fas fa-minus-circle\"></i></button></td>';
        // html += '</tr>';

        // \$('#product-category tbody').append(html);
    // }
// });

// \$('#product-category').on('click', '.btn', function () {
    // \$(this).parent().parent().remove();
// });
\t\t
</script>

";
        // line 1527
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/admin/view/template/module/purpletree_multivendor.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  3218 => 1527,  3183 => 1495,  3145 => 1460,  3140 => 1458,  3127 => 1448,  3121 => 1445,  3112 => 1439,  3106 => 1436,  3099 => 1432,  3084 => 1420,  3077 => 1416,  3036 => 1378,  3029 => 1374,  3000 => 1348,  2984 => 1335,  2968 => 1322,  2940 => 1297,  2929 => 1289,  2917 => 1280,  2912 => 1278,  2903 => 1271,  2897 => 1270,  2875 => 1267,  2870 => 1266,  2866 => 1264,  2862 => 1263,  2858 => 1261,  2852 => 1259,  2849 => 1258,  2843 => 1256,  2840 => 1255,  2834 => 1253,  2832 => 1252,  2828 => 1250,  2824 => 1249,  2818 => 1246,  2803 => 1233,  2798 => 1231,  2793 => 1230,  2788 => 1228,  2783 => 1227,  2781 => 1226,  2775 => 1223,  2768 => 1219,  2750 => 1206,  2741 => 1199,  2736 => 1197,  2731 => 1196,  2726 => 1194,  2721 => 1193,  2719 => 1192,  2713 => 1189,  2705 => 1183,  2700 => 1181,  2696 => 1180,  2691 => 1179,  2682 => 1177,  2674 => 1176,  2665 => 1175,  2663 => 1174,  2657 => 1171,  2648 => 1164,  2642 => 1162,  2640 => 1161,  2634 => 1160,  2629 => 1158,  2619 => 1155,  2613 => 1151,  2608 => 1149,  2603 => 1148,  2598 => 1146,  2593 => 1145,  2591 => 1144,  2585 => 1141,  2570 => 1128,  2565 => 1126,  2560 => 1125,  2555 => 1123,  2550 => 1122,  2548 => 1121,  2542 => 1118,  2534 => 1113,  2516 => 1097,  2509 => 1096,  2502 => 1095,  2499 => 1094,  2492 => 1093,  2488 => 1092,  2482 => 1091,  2476 => 1088,  2468 => 1082,  2463 => 1080,  2458 => 1079,  2453 => 1077,  2448 => 1076,  2446 => 1075,  2440 => 1072,  2433 => 1067,  2427 => 1065,  2425 => 1064,  2419 => 1063,  2414 => 1061,  2407 => 1056,  2401 => 1054,  2399 => 1053,  2393 => 1052,  2388 => 1050,  2381 => 1045,  2375 => 1043,  2373 => 1042,  2367 => 1041,  2362 => 1039,  2355 => 1034,  2349 => 1032,  2347 => 1031,  2341 => 1030,  2336 => 1028,  2329 => 1023,  2323 => 1021,  2321 => 1020,  2315 => 1019,  2310 => 1017,  2303 => 1012,  2297 => 1010,  2295 => 1009,  2289 => 1008,  2284 => 1006,  2277 => 1001,  2271 => 999,  2269 => 998,  2263 => 997,  2258 => 995,  2250 => 989,  2245 => 987,  2240 => 986,  2235 => 984,  2230 => 983,  2228 => 982,  2222 => 979,  2214 => 973,  2209 => 971,  2204 => 970,  2199 => 968,  2194 => 967,  2192 => 966,  2186 => 963,  2176 => 960,  2170 => 956,  2165 => 954,  2160 => 953,  2155 => 951,  2150 => 950,  2148 => 949,  2142 => 946,  2135 => 942,  2112 => 926,  2105 => 924,  2102 => 923,  2095 => 922,  2090 => 921,  2086 => 920,  2082 => 919,  2076 => 916,  2062 => 907,  2058 => 906,  2052 => 903,  2048 => 902,  2044 => 900,  2039 => 898,  2034 => 897,  2029 => 895,  2024 => 894,  2022 => 893,  2016 => 890,  2003 => 882,  1996 => 880,  1989 => 878,  1982 => 876,  1976 => 875,  1971 => 873,  1964 => 869,  1950 => 857,  1945 => 855,  1940 => 854,  1935 => 852,  1930 => 851,  1928 => 850,  1922 => 847,  1915 => 843,  1901 => 831,  1896 => 829,  1891 => 828,  1886 => 826,  1881 => 825,  1879 => 824,  1873 => 821,  1866 => 817,  1852 => 805,  1847 => 803,  1842 => 802,  1837 => 800,  1832 => 799,  1830 => 798,  1824 => 795,  1817 => 791,  1804 => 780,  1798 => 778,  1796 => 777,  1792 => 776,  1787 => 774,  1779 => 768,  1774 => 766,  1769 => 765,  1764 => 763,  1759 => 762,  1757 => 761,  1751 => 758,  1743 => 752,  1738 => 750,  1733 => 749,  1728 => 747,  1723 => 746,  1721 => 745,  1715 => 742,  1707 => 736,  1702 => 734,  1697 => 733,  1692 => 731,  1687 => 730,  1685 => 729,  1679 => 726,  1670 => 719,  1665 => 717,  1660 => 716,  1655 => 714,  1650 => 713,  1648 => 712,  1642 => 709,  1633 => 702,  1628 => 701,  1623 => 700,  1618 => 698,  1613 => 697,  1611 => 696,  1605 => 693,  1595 => 685,  1590 => 684,  1585 => 683,  1580 => 681,  1575 => 680,  1573 => 679,  1567 => 676,  1558 => 669,  1553 => 668,  1548 => 667,  1543 => 665,  1538 => 664,  1536 => 663,  1530 => 660,  1520 => 652,  1515 => 650,  1510 => 649,  1505 => 647,  1500 => 646,  1498 => 645,  1492 => 642,  1483 => 635,  1478 => 633,  1473 => 632,  1468 => 630,  1463 => 629,  1461 => 628,  1455 => 625,  1447 => 619,  1442 => 617,  1437 => 616,  1432 => 614,  1427 => 613,  1425 => 612,  1419 => 609,  1411 => 603,  1406 => 601,  1401 => 600,  1396 => 598,  1391 => 597,  1389 => 596,  1383 => 593,  1375 => 587,  1370 => 585,  1366 => 584,  1361 => 583,  1356 => 581,  1352 => 580,  1347 => 579,  1345 => 578,  1341 => 577,  1337 => 576,  1332 => 575,  1330 => 574,  1324 => 571,  1316 => 565,  1311 => 563,  1306 => 562,  1301 => 560,  1296 => 559,  1294 => 558,  1288 => 555,  1279 => 548,  1274 => 546,  1269 => 545,  1264 => 543,  1259 => 542,  1257 => 541,  1251 => 538,  1243 => 532,  1238 => 530,  1233 => 529,  1228 => 527,  1223 => 526,  1221 => 525,  1215 => 522,  1207 => 516,  1202 => 514,  1197 => 513,  1192 => 511,  1187 => 510,  1185 => 509,  1179 => 506,  1172 => 502,  1156 => 488,  1151 => 487,  1146 => 486,  1141 => 484,  1136 => 483,  1134 => 482,  1128 => 479,  1118 => 471,  1113 => 470,  1108 => 469,  1103 => 467,  1098 => 466,  1096 => 465,  1090 => 462,  1081 => 455,  1076 => 454,  1071 => 453,  1066 => 451,  1061 => 450,  1059 => 449,  1053 => 446,  1044 => 439,  1039 => 437,  1034 => 436,  1029 => 434,  1024 => 433,  1022 => 432,  1016 => 429,  1008 => 423,  1003 => 421,  998 => 420,  993 => 418,  988 => 417,  986 => 416,  980 => 413,  971 => 406,  966 => 404,  961 => 403,  956 => 401,  952 => 400,  949 => 399,  947 => 398,  941 => 395,  932 => 388,  929 => 387,  922 => 385,  916 => 383,  912 => 382,  905 => 381,  900 => 380,  898 => 379,  894 => 377,  888 => 375,  882 => 373,  880 => 372,  877 => 371,  872 => 369,  867 => 368,  862 => 366,  857 => 365,  855 => 364,  849 => 361,  841 => 355,  836 => 353,  831 => 352,  826 => 350,  821 => 349,  819 => 348,  813 => 345,  805 => 339,  800 => 337,  795 => 336,  790 => 334,  785 => 333,  783 => 332,  777 => 329,  771 => 325,  763 => 321,  758 => 319,  750 => 313,  745 => 311,  740 => 310,  735 => 308,  730 => 307,  728 => 306,  722 => 303,  716 => 300,  708 => 294,  703 => 292,  698 => 291,  693 => 289,  688 => 288,  686 => 287,  680 => 284,  671 => 277,  656 => 274,  653 => 273,  649 => 272,  641 => 267,  632 => 260,  626 => 259,  617 => 256,  609 => 253,  606 => 252,  604 => 251,  601 => 250,  597 => 249,  590 => 245,  581 => 238,  576 => 236,  571 => 235,  566 => 233,  561 => 232,  559 => 231,  553 => 228,  542 => 222,  537 => 220,  528 => 213,  523 => 211,  518 => 210,  513 => 208,  508 => 207,  506 => 206,  500 => 203,  491 => 196,  485 => 194,  483 => 193,  479 => 192,  474 => 190,  463 => 182,  458 => 180,  450 => 174,  444 => 172,  442 => 171,  438 => 170,  433 => 168,  425 => 162,  420 => 160,  415 => 159,  410 => 157,  405 => 156,  403 => 155,  397 => 152,  390 => 147,  384 => 145,  382 => 144,  379 => 143,  362 => 141,  358 => 140,  352 => 137,  345 => 132,  339 => 130,  337 => 129,  334 => 128,  317 => 126,  313 => 125,  307 => 122,  300 => 118,  286 => 107,  280 => 104,  276 => 103,  271 => 101,  267 => 100,  261 => 97,  254 => 93,  247 => 89,  243 => 88,  226 => 74,  220 => 71,  215 => 69,  211 => 68,  206 => 66,  199 => 61,  194 => 59,  189 => 58,  184 => 56,  179 => 55,  177 => 54,  171 => 51,  163 => 46,  159 => 45,  155 => 44,  151 => 43,  147 => 42,  143 => 41,  139 => 40,  133 => 37,  128 => 35,  125 => 34,  119 => 32,  116 => 31,  108 => 27,  105 => 26,  97 => 22,  95 => 21,  89 => 17,  78 => 15,  74 => 14,  69 => 12,  66 => 11,  58 => 9,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/admin/view/template/module/purpletree_multivendor.twig", "C:\\wamp\\www\\tutor\\extension\\purpletree_multivendor\\admin\\view\\template\\module\\purpletree_multivendor.twig");
    }
}

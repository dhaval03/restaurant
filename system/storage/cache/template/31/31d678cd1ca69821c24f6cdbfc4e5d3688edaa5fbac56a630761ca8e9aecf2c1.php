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

/* extension/purpletree_multivendor/admin/view/template/multivendor/store_list.twig */
class __TwigTemplate_d6e6fdb9a05b0bd65d1b04b03207fcec925cc3e6d43a317dadd206f2b7e4afc5 extends Template
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
\t\t\t<div class=\"float-end\">
\t\t\t<button type=\"submit\" id=\"button-approve\" form=\"form-store\" formaction=\"";
        // line 7
        echo ($context["approve"] ?? null);
        echo "\" data-bs-toggle=\"tooltip\" title=\"";
        echo ($context["button_approve"] ?? null);
        echo "\" class=\"btn btn-success\">";
        echo ($context["button_approve"] ?? null);
        echo "</i></button>
\t\t\t<button type=\"submit\" id=\"button-disapprove\" form=\"form-store\" formaction=\"";
        // line 8
        echo ($context["disapprove"] ?? null);
        echo "\" data-bs-toggle=\"tooltip\" title=\"";
        echo ($context["button_disapprove"] ?? null);
        echo "\" class=\"btn btn-danger\">";
        echo ($context["button_disapprove"] ?? null);
        echo "</i></button>
\t\t";
        // line 9
        if (($context["helpcheck"] ?? null)) {
            // line 10
            echo "\t\t<a href=\"";
            echo ($context["helplink"] ?? null);
            echo "\" rel=”nofollow”  target=\"_blank\" id=\"button-pts-help\" class=\"btn\"><img src=\"";
            echo ($context["helpimage"] ?? null);
            echo "\" alt=\"Help\" width=\"85\" height=\"43\"></a>
\t\t";
        }
        // line 12
        echo "\t</div>\t\t
\t<h1>";
        // line 13
        echo ($context["heading_title"] ?? null);
        echo "</h1>
\t<ul class=\"breadcrumb\">
\t\t";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 16
            echo "        <li class=\"breadcrumb-item\"><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 16);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 16);
            echo "</a></li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "\t</ul>
</div>
</div>
<div class=\"container-fluid\">
    ";
        // line 22
        if (($context["error_warning"] ?? null)) {
            // line 23
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
\t</div>
    ";
        }
        // line 27
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 28
            echo "    <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
\t\t<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
\t</div>
    ";
        }
        // line 32
        echo "    <div class=\"panel panel-default card\">
\t\t<div class=\"panel-heading\">
\t\t\t<h3 class=\"panel-title card-header\"><i class=\"fa fa-list\"></i> ";
        // line 34
        echo ($context["text_list"] ?? null);
        echo "</h3>
\t\t</div>
\t\t<div class=\"panel-body card-body\">
\t\t\t<div class=\"well card mb-3 p-3\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t<label class=\"form-label\" for=\"input-name\">";
        // line 40
        echo ($context["entry_storename"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<input type=\"text\" name=\"filter_name\" value=\"";
        // line 41
        echo ($context["filter_name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_storename"] ?? null);
        echo "\" id=\"input-name\" list=\"filter-store-name\" class=\"form-control\" />
\t\t\t\t\t\t\t<datalist id=\"filter-store-name\"></datalist>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-sm-3\">\t
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<label class=\"form-label\" for=\"input-status\">";
        // line 46
        echo ($context["entry_storestatus"] ?? null);
        echo "</label>
\t\t\t\t\t\t\t<select name=\"filter_status\" id=\"input-status\" class=\"form-select\">
\t\t\t\t\t\t\t\t<option value=\"*\">";
        // line 48
        echo ($context["text_all"] ?? null);
        echo "</option>
\t\t\t\t\t\t\t\t";
        // line 49
        if ((($context["filter_status"] ?? null) == "1")) {
            // line 50
            echo "\t\t\t\t\t\t\t\t<option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t";
        } else {
            // line 52
            echo "\t\t\t\t\t\t\t\t<option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t";
        }
        // line 54
        echo "\t\t\t\t\t\t\t\t";
        if ((($context["filter_status"] ?? null) == "0")) {
            // line 55
            echo "\t\t\t\t\t\t\t\t<option value=\"0\" selected=\"selected\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t";
        } else {
            // line 57
            echo "\t\t\t\t\t\t\t\t<option value=\"0\">";
            echo ($context["text_disabled"] ?? null);
            echo "</option>
\t\t\t\t\t\t\t\t";
        }
        // line 59
        echo "\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t<label for=\"input-date-added\" class=\"form-label\">";
        // line 63
        echo ($context["entry_date_added"] ?? null);
        echo "</label>
\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t<input type=\"text\" name=\"filter_date_added\" value=\"\" placeholder=\"";
        // line 65
        echo ($context["entry_date_added"] ?? null);
        echo "\" id=\"input-date-added\" class=\"form-control\"/>
\t\t\t\t\t<div class=\"input-group-text\"><i class=\"fas fa-calendar\"></i></div>
\t\t\t\t\t</div>    \t\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-sm-3 ptsc-storeli-martop py-4\"> \t\t   
\t\t\t\t\t\t\t<button type=\"button\" id=\"button-filter\" class=\"btn btn-primary pull-right float-end\"><i class=\"fa fa-filter\"></i> 
\t\t\t\t\t\t\t";
        // line 71
        echo ($context["button_filter"] ?? null);
        echo "</button>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<form action=\"\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-store\">
\t\t\t\t<div class=\"table-responsive\">
\t\t\t\t\t<table class=\"table table-bordered table-hover\">
\t\t\t\t\t\t<thead>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td class=\"text-center ptsc-vendorlis-width\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
        // line 81
        if ((($context["sort"] ?? null) == "store_name")) {
            // line 82
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_storename"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t\t";
        } else {
            // line 84
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_name"] ?? null);
            echo "\">";
            echo ($context["column_storename"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t";
        }
        // line 85
        echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
        // line 86
        if ((($context["sort"] ?? null) == "store_email")) {
            // line 87
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_email"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_storeemail"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t\t";
        } else {
            // line 89
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_email"] ?? null);
            echo "\">";
            echo ($context["column_storeemail"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t";
        }
        // line 90
        echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">
\t\t\t\t\t\t\t\t\t";
        // line 92
        echo ($context["column_storephone"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">
\t\t\t\t\t\t\t\t\t";
        // line 95
        echo ($context["column_storeaddress"] ?? null);
        echo "
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
        // line 97
        if ((($context["sort"] ?? null) == "c.name")) {
            // line 98
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_seller_name"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t\t";
        } else {
            // line 100
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_seller_name"] ?? null);
            echo "\">";
            echo ($context["column_name"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t";
        }
        // line 101
        echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
        // line 102
        if ((($context["sort"] ?? null) == "c.status")) {
            // line 103
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_status"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_storestatus"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t\t";
        } else {
            // line 105
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_status"] ?? null);
            echo "\">";
            echo ($context["column_storestatus"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t";
        }
        // line 106
        echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
        // line 107
        if ((($context["sort"] ?? null) == "c.date_added")) {
            // line 108
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_date_added"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_date_added"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t\t";
        } else {
            // line 110
            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
            echo ($context["sort_date_added"] ?? null);
            echo "\">";
            echo ($context["column_date_added"] ?? null);
            echo "</a>
\t\t\t\t\t\t\t\t";
        }
        // line 111
        echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-right\">";
        // line 112
        echo ($context["column_action"] ?? null);
        echo "</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</thead>
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t";
        // line 116
        if (($context["stores"] ?? null)) {
            // line 117
            echo "\t\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 118
                echo "\t\t\t\t\t\t\t";
                if ((twig_get_attribute($this->env, $this->source, $context["store"], "status", [], "any", false, false, false, 118) == 1)) {
                    // line 119
                    echo "\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td class=\"text-center\">";
                    // line 120
                    if (twig_in_filter(($context["selected"] ?? null), twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 120))) {
                        // line 121
                        echo "\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"selected[]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 121);
                        echo "\" checked=\"checked\" />
\t\t\t\t\t\t\t\t\t";
                    } else {
                        // line 123
                        echo "\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"selected[]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 123);
                        echo "\" />
\t\t\t\t\t\t\t\t";
                    }
                    // line 124
                    echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
                    // line 125
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_name", [], "any", false, false, false, 125);
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "is_removed", [], "any", false, false, false, 125);
                    echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
                    // line 126
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_email", [], "any", false, false, false, 126);
                    echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
                    // line 127
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_phone", [], "any", false, false, false, 127);
                    echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
                    // line 128
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_address", [], "any", false, false, false, 128);
                    echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\"><a href=\"";
                    // line 129
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "seller_url", [], "any", false, false, false, 129);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "seller_name", [], "any", false, false, false, 129);
                    echo "</a></td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
                    // line 130
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_status", [], "any", false, false, false, 130);
                    echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-left\">";
                    // line 131
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "store_created_at", [], "any", false, false, false, 131);
                    echo "</td>
\t\t\t\t\t\t\t\t<td class=\"text-right\">
\t\t\t\t\t\t\t\t<a href=\"";
                    // line 133
                    echo twig_get_attribute($this->env, $this->source, $context["store"], "edit", [], "any", false, false, false, 133);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_edit"] ?? null);
                    echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil fas fa-edit\"></i></a></td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t";
                }
                // line 136
                echo "\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 137
            echo "\t\t\t\t\t\t\t";
        } else {
            // line 138
            echo "\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td class=\"text-center\" colspan=\"9\">";
            // line 139
            echo ($context["text_no_results"] ?? null);
            echo "</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t";
        }
        // line 142
        echo "\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</form>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-sm-6 text-start\">";
        // line 147
        echo ($context["pagination"] ?? null);
        echo "</div>
\t\t\t\t<div class=\"col-sm-6 text-end\">";
        // line 148
        echo ($context["results"] ?? null);
        echo "</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
<script type=\"text/javascript\"><!--
\$('#customer').on('click', 'thead a, .pagination a', function(e) {
    e.preventDefault();

    \$('#customer').load(this.href);
});

    \$('#button-approve, #button-disapprove').on('click', function(e) {
\t\t
\t\tif(confirm('";
        // line 162
        echo ($context["text_confirm"] ?? null);
        echo "')) {
\t\t\t\$('#form-store').attr('action', this.getAttribute('formAction'));   
\t\t}
\t\telse { 
\t\t\treturn false;
\t\t}
\t});
\t\$('#button-filter').on('click', function() {
\t\turl = 'index.php?route=extension/purpletree_multivendor/multivendor/stores&user_token=";
        // line 170
        echo ($context["user_token"] ?? null);
        echo "';
\t\t
\t\tvar filter_name = \$('input[name=\\'filter_name\\']').val();
\t\t
\t\tif (filter_name) {
\t\t\turl += '&filter_name=' + encodeURIComponent(filter_name);
\t\t}
\t\t
\t\t/*var filter_email = \$('input[name=\\'filter_email\\']').val();
\t\t\t
\t\t\tif (filter_email) {
\t\t\turl += '&filter_email=' + encodeURIComponent(filter_email);
\t\t} */
\t\t
\t\tvar filter_customer_group_id = \$('select[name=\\'filter_customer_group_id\\']').val();
\t\t
\t\tif (filter_customer_group_id != '*') {
\t\t\turl += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);
\t\t}\t
\t\t
\t\tvar filter_status = \$('select[name=\\'filter_status\\']').val();
\t\t
\t\tif (filter_status != '*') {
\t\t\turl += '&filter_status=' + encodeURIComponent(filter_status); 
\t\t}\t
\t\t
\t\tvar filter_approved = \$('select[name=\\'filter_approved\\']').val();
\t\t
\t\tif (filter_approved != '*') {
\t\t\turl += '&filter_approved=' + encodeURIComponent(filter_approved);
\t\t}\t
\t\t
\t\tvar filter_ip = \$('input[name=\\'filter_ip\\']').val();
\t\t
\t\tif (filter_ip) {
\t\t\turl += '&filter_ip=' + encodeURIComponent(filter_ip);
\t\t}
\t\t
\t\tvar filter_date_added = \$('input[name=\\'filter_date_added\\']').val();
\t\t
\t\tif (filter_date_added) {
\t\t\turl += '&filter_date_added=' + encodeURIComponent(filter_date_added);
\t\t}
\t\t
\t\tlocation = url;
\t});
//--></script> 
<script type=\"text/javascript\"><!--
\t\$('input[name=\\'filter_name\\']').autocomplete({
\t\t'source': function(request, response) {
\t\t\t\$.ajax({
\t\t\t\turl: 'index.php?route=extension/purpletree_multivendor/multivendor/stores|autocomplete&user_token=";
        // line 221
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\t\tdataType: 'json',\t\t\t
\t\t\t\tsuccess: function(json) {
\t\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\t\treturn {
\t\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\t\tvalue: item['customer_id']
\t\t\t\t\t\t}
\t\t\t\t\t}));
\t\t\t\t}
\t\t\t});
\t\t},
\t\t'select': function(item) {
\t\t\t\$('input[name=\\'filter_name\\']').val(item['label']);
\t\t}\t
\t});
\t
\t/*\$('input[name=\\'filter_email\\']').autocomplete({
\t\t'source': function(request, response) {
\t\t\$.ajax({
\t\turl: 'index.php?route=extension/purpletree_multivendor/stores/autocomplete&user_token=";
        // line 241
        echo ($context["user_token"] ?? null);
        echo "&filter_email=' +  encodeURIComponent(request),
\t\tdataType: 'json',\t\t\t
\t\tsuccess: function(json) {
\t\tresponse(\$.map(json, function(item) {
\t\treturn {
\t\tlabel: item['email'],
\t\tvalue: item['customer_id']
\t\t}
\t\t}));
\t\t}
\t\t});
\t\t},
\t\t'select': function(item) {
\t\t\$('input[name=\\'filter_email\\']').val(item['label']);
\t\t}\t
\t}); */
//--></script> 
\t<script type=\"text/javascript\">
\$(function() {

  \$('input[name=\"filter_date_added\"]').daterangepicker({
      autoUpdateInput: false,
\t  singleDatePicker: true,
\t  showDropdowns: true,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  \$('input[name=\"filter_date_added\"]').on('apply.daterangepicker', function(ev, picker) {
      \$(this).val(picker.startDate.format('YYYY-MM-DD'));
  });

  \$('input[name=\"filter_date_added\"]').on('cancel.daterangepicker', function(ev, picker) {
      \$(this).val('');
  });

});
</script>
";
        // line 280
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "extension/purpletree_multivendor/admin/view/template/multivendor/store_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  603 => 280,  561 => 241,  538 => 221,  484 => 170,  473 => 162,  456 => 148,  452 => 147,  445 => 142,  439 => 139,  436 => 138,  433 => 137,  427 => 136,  419 => 133,  414 => 131,  410 => 130,  404 => 129,  400 => 128,  396 => 127,  392 => 126,  387 => 125,  384 => 124,  378 => 123,  372 => 121,  370 => 120,  367 => 119,  364 => 118,  359 => 117,  357 => 116,  350 => 112,  347 => 111,  339 => 110,  329 => 108,  327 => 107,  324 => 106,  316 => 105,  306 => 103,  304 => 102,  301 => 101,  293 => 100,  283 => 98,  281 => 97,  276 => 95,  270 => 92,  266 => 90,  258 => 89,  248 => 87,  246 => 86,  243 => 85,  235 => 84,  225 => 82,  223 => 81,  210 => 71,  201 => 65,  196 => 63,  190 => 59,  184 => 57,  178 => 55,  175 => 54,  169 => 52,  163 => 50,  161 => 49,  157 => 48,  152 => 46,  142 => 41,  138 => 40,  129 => 34,  125 => 32,  117 => 28,  114 => 27,  106 => 23,  104 => 22,  98 => 18,  87 => 16,  83 => 15,  78 => 13,  75 => 12,  67 => 10,  65 => 9,  57 => 8,  49 => 7,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/purpletree_multivendor/admin/view/template/multivendor/store_list.twig", "C:\\wamp\\www\\tutor\\extension\\purpletree_multivendor\\admin\\view\\template\\multivendor\\store_list.twig");
    }
}

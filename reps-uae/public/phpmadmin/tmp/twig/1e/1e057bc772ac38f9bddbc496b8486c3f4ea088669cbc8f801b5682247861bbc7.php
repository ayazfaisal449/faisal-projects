<?php

/* radio_fields.twig */
class __TwigTemplate_611951d42318c5450ecf6ec96c56974e23724786b30514541e0bae8d7a864e81 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ( !twig_test_empty((isset($context["class"]) ? $context["class"] : null))) {
            // line 2
            echo "<div class=\"";
            echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
            echo "\">
";
        }
        // line 4
        echo "<input type=\"radio\" name=\"";
        echo twig_escape_filter($this->env, (isset($context["html_field_name"]) ? $context["html_field_name"] : null), "html", null, true);
        echo "\" id=\"";
        echo (isset($context["html_field_id"]) ? $context["html_field_id"] : null);
        echo "\" value=\"";
        echo twig_escape_filter($this->env, (isset($context["choice_value"]) ? $context["choice_value"] : null), "html", null, true);
        echo "\"";
        echo (((isset($context["checked"]) ? $context["checked"] : null)) ? (" checked=\"checked\"") : (""));
        echo " />
<label for=\"";
        // line 5
        echo (isset($context["html_field_id"]) ? $context["html_field_id"] : null);
        echo "\">";
        echo (((isset($context["escape_label"]) ? $context["escape_label"] : null)) ? (twig_escape_filter($this->env, (isset($context["choice_label"]) ? $context["choice_label"] : null))) : ((isset($context["choice_label"]) ? $context["choice_label"] : null)));
        echo "</label>
";
        // line 6
        if ((isset($context["is_line_break"]) ? $context["is_line_break"] : null)) {
            // line 7
            echo "<br />
";
        }
        // line 9
        if ( !twig_test_empty((isset($context["class"]) ? $context["class"] : null))) {
            // line 10
            echo "</div>
";
        }
    }

    public function getTemplateName()
    {
        return "radio_fields.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 10,  50 => 9,  46 => 7,  44 => 6,  38 => 5,  27 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "radio_fields.twig", "/var/www/repsuae/public/phpmadmin/templates/radio_fields.twig");
    }
}

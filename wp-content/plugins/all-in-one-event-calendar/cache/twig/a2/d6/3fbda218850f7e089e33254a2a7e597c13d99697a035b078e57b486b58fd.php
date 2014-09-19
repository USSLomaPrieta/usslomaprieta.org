<?php

/* notification/admin.twig */
class __TwigTemplate_a2d63fbda218850f7e089e33254a2a7e597c13d99697a035b078e57b486b58fd extends Twig_Template
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
        echo "<div class=\"message ";
        echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : null), "html", null, true);
        echo " ai1ec-message\">
\t";
        // line 2
        if ((!array_key_exists("label", $context))) {
            // line 3
            echo "          ";
            $context["label"] = (isset($context["text_label"]) ? $context["text_label"] : null);
            // line 4
            echo "\t";
        }
        // line 5
        echo "\t<h3>";
        echo twig_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
        echo "</h3>

\t<p>";
        // line 7
        echo (isset($context["message"]) ? $context["message"] : null);
        echo "</p>

\t";
        // line 9
        if (((isset($context["persistent"]) ? $context["persistent"] : null) == true)) {
            // line 10
            echo "\t\t<div>
\t\t\t<input type=\"button\" class=\"button ai1ec-dismissable\"
\t\t\t\tdata-key=\"";
            // line 12
            echo twig_escape_filter($this->env, (isset($context["msg_key"]) ? $context["msg_key"] : null), "html", null, true);
            echo "\"
\t\t\t\tvalue=\"";
            // line 13
            echo twig_escape_filter($this->env, Ai1ec_I18n::__("Dismiss"), "html", null, true);
            echo "\">
\t\t</div>
\t\t<p></p>
\t";
        }
        // line 17
        echo "\t";
        if ((isset($context["button"]) ? $context["button"] : null)) {
            // line 18
            echo "\t\t<div>
\t\t\t<input type=\"button\" class=\"button ";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["button"]) ? $context["button"] : null), "class"), "html", null, true);
            echo "\"
\t\t\t\tvalue=\"";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["button"]) ? $context["button"] : null), "value"), "html", null, true);
            echo "\">
\t\t</div>
\t\t<p></p>
\t";
        }
        // line 24
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "notification/admin.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 24,  70 => 20,  66 => 19,  63 => 18,  60 => 17,  53 => 13,  45 => 10,  43 => 9,  38 => 7,  29 => 4,  26 => 3,  71 => 28,  58 => 17,  52 => 14,  49 => 12,  47 => 12,  40 => 8,  36 => 7,  32 => 5,  28 => 5,  24 => 2,  19 => 1,);
    }
}

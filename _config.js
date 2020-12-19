import lume from "https://deno.land/x/lume/mod.js";
import css from "https://deno.land/x/lume/plugins/css.js";

const site = lume();

site.use(css());
site.ignore("README.md");
site.copy("static", "");

export default site;

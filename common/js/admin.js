jQuery(document).ready(function(e){function t(){if("readonly"!==e('.ppc-roles-tab-content input[name="role_slug"]').attr("readonly")){var t=e('.ppc-roles-tab-content input[name="role_slug"]').val(),i=e("#pp-role-slug-exists");e(".ppc-roles-all-roles").val().split(",").includes(t)?i.show():i.hide()}}e("a.neg-cap").attr("title",cmeAdmin.negationCaption),e("a.neg-type-caps").attr("title",cmeAdmin.typeCapsNegationCaption),e("td.cap-unreg").attr("title",cmeAdmin.typeCapUnregistered),e("a.normal-cap").attr("title",cmeAdmin.switchableCaption),e("span.cap-x").attr("title",cmeAdmin.capNegated),e('table.cme-checklist input[class!="cme-check-all"]').not(":disabled").attr("title",cmeAdmin.chkCaption),e("table.cme-checklist a.neg-cap").click(function(t){e(this).closest("td").removeClass("cap-yes").removeClass("cap-no").addClass("cap-neg");var i=e(this).parent().find('input[type="checkbox"]').attr("name");return e(this).after('<input type="hidden" class="cme-negation-input" name="'+i+'" value="" />'),e('input[name="'+i+'"]').closest("td").removeClass("cap-yes").removeClass("cap-no").addClass("cap-neg"),!1}),e(document).on("click","table.cme-typecaps span.cap-x,table.cme-checklist span.cap-x,table.cme-checklist td.cap-neg span",function(t){e(this).closest("td").removeClass("cap-neg").removeClass("cap-yes").addClass("cap-no"),e(this).parent().find('input[type="checkbox"]').prop("checked",!1),e(this).parent().find("input.cme-negation-input").remove();var i=e(this).next('input[type="checkbox"]').attr("name");return i||(i=e(this).next("label").find('input[type="checkbox"]').attr("name")),e('input[name="'+i+'"]').parent().closest("td").removeClass("cap-neg").removeClass("cap-yes").addClass("cap-no"),e('input[name="'+i+'"]').prop("checked",!1).parent().find("input.cme-negation-input").remove(),!1}),e("#publishpress_caps_form").bind("keypress",function(t){if(13==t.keyCode)return e(document.activeElement).parent().find('input[type="submit"]').first().click(),!1}),e("input.cme-check-all").click(function(t){e(this).closest("table").find('input[type="checkbox"][disabled!="disabled"]:visible').prop("checked",e(this).is(":checked"))}),e("a.cme-neg-all").click(function(t){return e(this).closest("table").find("a.neg-cap:visible").click(),!1}),e("a.cme-switch-all").click(function(t){return e(this).closest("table").find("td.cap-neg span").click(),!1}),e("table.cme-typecaps a.neg-type-caps").click(function(t){return e(this).closest("tr").find('td[class!="cap-neg"]').filter('td[class!="cap-unreg"]').each(function(){e(this).addClass("cap-neg");var t=e(this).find('input[type="checkbox"]').attr("name");e(this).append('<input type="hidden" class="cme-negation-input" name="'+t+'" value="" />'),e('input[name="'+t+'"]').parent().next("a.neg-cap:visible").click()}),!1}),e("table.cme-typecaps th").click(function(){var t=e(this).index(),i=!e(this).prop("checked_all");if(e(this).hasClass("term-cap"))var a='[class*="term-cap"]';else a='[class*="post-cap"]';var s=e(this).closest("table").find("tr td"+a+":nth-child("+(t+1)+') input[type="checkbox"]:visible');e(s).each(function(t,a){e('input[name="'+e(this).attr("name")+'"]').prop("checked",i)}),e(this).prop("checked_all",i)}),e("a.cme-fix-read-cap").click(function(){return e('input[name="caps[read]"]').prop("checked",!0),e('input[name="SaveRole"]').trigger("click"),!1}),e(".ppc-filter-select").each(function(){var t=e(this),i=new Array;e(this).parent().siblings("table").find("tbody").find("tr").each(function(){i.push({value:e(this).attr("class"),text:e(this).find(".cap_type").text()})}),i.forEach(function(i,a){t.append(e("<option>",{value:i.value,text:i.text}))})}),e(".ppc-filter-select").prop("selectedIndex",0),e(".ppc-filter-select-reset").click(function(){e(this).prev(".ppc-filter-select").prop("selectedIndex",0),e(this).parent().siblings("table").find("tr").show()}),e(".ppc-filter-select").change(function(){e(this).val()?(e(this).parent().siblings("table").find("tr").hide(),e(this).parent().siblings("table").find("thead tr:first-child").show(),e(this).parent().siblings("table").find("tr."+e(this).val()).show()):e(this).parent().siblings("table").find("tr").show()}),e(".ppc-filter-text").val(""),e(".ppc-filter-text-reset").click(function(){e(this).prev(".ppc-filter-text").val(""),e(this).parent().siblings("table").find("tr").show(),e(this).parent().siblings(".ppc-filter-no-results").hide()}),e(".ppc-filter-text").keyup(function(){e(this).parent().siblings("table").find("tr").hide(),e(this).parent().siblings("table").find('tr[class*="'+e(this).val()+'"]').show(),e(this).parent().siblings("table").find("tr.cme-bulk-select").hide(),0===e(this).val().length&&e(this).parent().siblings("table").find("tr").show(),0===e(this).parent().siblings("table").find("tr:visible").length?e(this).parent().siblings(".ppc-filter-no-results").show():e(this).parent().siblings(".ppc-filter-no-results").hide()}),e(document).on("click",".ppc-roles-tab li",function(t){t.preventDefault();var i=e(this).attr("data-tab");e(".ppc-roles-tab li").removeClass("active"),e(this).addClass("active"),e(".pp-roles-tab-tr").hide(),e(".pp-roles-"+i+"-tab").show()}),e(document).on("click",".roles-capabilities-load-more",function(t){t.preventDefault(),e(".roles-capabilities-load-more").hide(),e(".roles-capabilities-load-less").show(),e("ul.pp-roles-capabilities li").show()}),e(document).on("click",".roles-capabilities-load-less",function(t){t.preventDefault(),e(".roles-capabilities-load-less").hide(),e(".roles-capabilities-load-more").show(),e("ul.pp-roles-capabilities li").hide(),e("ul.pp-roles-capabilities").children().slice(0,4).show(),window.scrollTo({top:0,behavior:"smooth"})}),e('.ppc-roles-tab-content input[name="role_slug"]').on("keyup",function(e){t()}),e("#pp-role-slug-exists").length>0&&t()});
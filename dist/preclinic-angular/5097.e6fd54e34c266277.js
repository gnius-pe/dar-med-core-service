"use strict";(self.webpackChunkpreclinic_angular=self.webpackChunkpreclinic_angular||[]).push([[5097],{5097:(C,p,a)=>{a.r(p),a.d(p,{AddInvoiceModule:()=>r});var Z=a(6895),v=a(27),l=a(433),m=a(6382),e=a(4650),u=a(3125),_=a(9549),A=a(4385),U=a(3238);function T(o,t){if(1&o&&(e.TgZ(0,"mat-option",169),e._uU(1),e.qZA()),2&o){const i=t.$implicit;e.Q6J("value",i.value),e.xp6(1),e.hij(" ",i.value," ")}}function b(o,t){if(1&o){const i=e.EpF();e.TgZ(0,"tr",170)(1,"td"),e._UZ(2,"input",156),e.qZA(),e.TgZ(3,"td"),e._UZ(4,"input",156),e.qZA(),e.TgZ(5,"td"),e._UZ(6,"input",156),e.qZA(),e.TgZ(7,"td"),e._UZ(8,"input",156),e.qZA(),e.TgZ(9,"td"),e._UZ(10,"input",156),e.qZA(),e.TgZ(11,"td"),e._UZ(12,"input",156),e.qZA(),e.TgZ(13,"td",171)(14,"a",172),e.NdJ("click",function(){e.CHM(i);const d=e.oxw();return e.KtG(d.addItem())}),e._UZ(15,"i",173),e.qZA(),e.TgZ(16,"a",174),e._UZ(17,"i",175),e.qZA(),e.TgZ(18,"a",176)(19,"i",177),e.NdJ("click",function(){const g=e.CHM(i).index,x=e.oxw();return e.KtG(x.deleteItem(g))}),e.qZA()()()()}}function h(o,t){if(1&o){const i=e.EpF();e.TgZ(0,"div",181),e.NdJ("click",function(){e.CHM(i);const d=e.oxw().index,g=e.oxw();return e.KtG(g.deleteCharges(d))}),e.TgZ(1,"a",182),e._UZ(2,"i",183),e._uU(3,"Service Charge "),e.qZA()()}}function f(o,t){if(1&o&&(e.TgZ(0,"div",178)(1,"div",179),e.YNc(2,h,4,0,"div",180),e.qZA()()),2&o){const i=t.index;e.xp6(2),e.Q6J("ngIf",i)}}const q=function(){return{standalone:!0}};class s{constructor(){this.routes=m._,this.checkboxes=[],this.itemDetails=[0],this.chargesArray=[0],this.recurringInvoice=!1,this.date=new l.NI(new Date),this.selecedList=[{value:"By month"},{value:"March"},{value:"April"},{value:"May"},{value:"June"},{value:"July"}]}openCheckBoxes(t){this.checkboxes[0]!=t?this.checkboxes[0]=t:this.checkboxes=[]}addItem(){this.itemDetails.push(0)}deleteItem(t){this.itemDetails.splice(t,1)}addCharges(){this.chargesArray.push(1)}deleteCharges(t){this.chargesArray.splice(t,1)}recurringInvoiceFunc(){this.recurringInvoice=!this.recurringInvoice}}s.\u0275fac=function(t){return new(t||s)},s.\u0275cmp=e.Xpm({type:s,selectors:[["app-add-invoice"]],decls:496,vars:16,consts:[[1,"page-wrapper"],[1,"content","container-fluid"],[1,"page-header","invoices-page-header"],[1,"row","align-items-center"],[1,"col"],[1,"breadcrumb","invoices-breadcrumb"],[1,"breadcrumb-item","invoices-breadcrumb-item"],[3,"routerLink"],[1,"fa","fa-chevron-left"],[1,"col-auto"],[1,"invoices-create-btn"],["href","javascript:void(0);","data-bs-toggle","modal","data-bs-target","#invoices_preview",1,"invoices-preview-link"],[1,"fa","fa-eye"],["href","javascript:void(0);","data-bs-toggle","modal","data-bs-target","#delete_invoices_details",1,"btn","delete-invoice-btn"],["href","javascript:void(0);","data-bs-toggle","modal","data-bs-target","#save_invocies_details",1,"btn","save-invoice-btn"],[1,"row"],[1,"col-md-12"],[1,"card","invoices-add-card"],[1,"card-body"],["action","#",1,"invoices-form"],[1,"invoices-main-form"],[1,"col-xl-4","col-md-6","col-sm-12","col-12"],[1,"form-group"],[1,"multipleSelection"],[1,"selectBox",3,"click"],[1,"mb-0"],[1,"down-icon"],[1,"fa","fa-chevron-down"],["id","checkBoxes-one",3,"ngClass"],[1,"checkbox-title"],[1,"form-custom"],["type","text","placeholder","Enter Customer Name",1,"form-control","bg-grey"],[1,"selectBox-cont"],[1,"custom_check","w-100"],["type","checkbox","name","username"],[1,"checkmark"],["type","submit",1,"btn","w-100","btn-primary","mb-2"],["type","reset",1,"btn","w-100","btn-grey"],["type","text","placeholder","Enter Reference Number",1,"form-control"],[1,"col-xl-5","col-md-6","col-sm-12","col-12"],[1,"invoice-details-title"],[1,"invoice-details-box"],[1,"invoice-inner-head"],[1,"invoice-inner-footer"],[1,"col-lg-6","col-md-6"],[1,"invoice-inner-date"],["type","text","matInput","",1,"form-control","datetimepicker",3,"formControl","matDatepicker"],["picker1",""],["matIconSuffix","",1,"toggle-date-picker",3,"for"],[1,"invoice-inner-date","invoice-inner-datepic"],["type","text","placeholder","Select","matInput","",1,"form-control","datetimepicker",3,"matDatepicker"],["picker2",""],[1,"col-xl-3","col-md-12","col-sm-12","col-12"],[1,"inovices-month-info"],[1,"form-group","mb-0"],["type","checkbox","id","enableTax","name","invoice"],["type","checkbox","id","chkYes","name","invoice",3,"click"],["id","show-invoices",3,"ngClass"],[1,"col-md-6"],["placeholder","By month",1,"form-control","select",3,"ngModel","ngModelOptions","ngModelChange"],[3,"value",4,"ngFor","ngForOf"],["type","text","placeholder","Enter Months",1,"form-control"],[1,"invoice-item"],[1,"col-xl-4","col-lg-6","col-md-6"],[1,"invoice-info"],[1,"customer-text"],[1,"small",3,"routerLink"],[1,"invoice-details","invoice-details-two"],[1,"invoice-add-table"],[1,"table-responsive"],[1,"table","table-striped","table-nowrap","mb-0","no-footer","add-table-items"],["class","add-row",4,"ngFor","ngForOf"],[1,"col-lg-7","col-md-6"],[1,"invoice-fields"],[1,"field-title"],[1,"field-box"],["href","javascript:void(0);","data-bs-toggle","modal","data-bs-target","#bank_details",1,"btn","btn-primary"],[1,"fas","fa-plus-circle","me-2"],[1,"invoice-faq"],["id","accordion","role","tablist","aria-multiselectable","true",1,"panel-group"],[1,"faq-tab"],[1,"panel","panel-default"],["role","tab","id","headingTwo",1,"panel-heading"],[1,"panel-title"],["data-bs-toggle","collapse","data-bs-parent","#accordion","href","#collapseTwo","aria-expanded","false","aria-controls","collapseTwo",1,"collapsed"],[1,"fas","fa-plus-circle","me-1"],["id","collapseTwo","role","tabpanel","aria-labelledby","headingTwo","data-bs-parent","#accordion",1,"panel-collapse","collapse"],[1,"panel-body"],[1,"form-control"],["role","tab","id","headingThree",1,"panel-heading"],["data-bs-toggle","collapse","data-bs-parent","#accordion","href","#collapseThree","aria-expanded","false","aria-controls","collapseThree",1,"collapsed"],["id","collapseThree","role","tabpanel","aria-labelledby","headingThree","data-bs-parent","#accordion",1,"panel-collapse","collapse"],[1,"col-lg-5","col-md-6"],[1,"invoice-total-card"],[1,"invoice-total-title"],[1,"invoice-total-box"],[1,"invoice-total-inner"],["type","checkbox","id","status_1",1,"check"],["for","status_1",1,"checktoggles"],["class","links-info-one",4,"ngFor","ngForOf"],["href","javascript:void(0);",1,"add-links1",3,"click"],[1,"links-info-discount"],[1,"links-cont-discount"],["href","javascript:void(0);",1,"add-links-one"],[1,"invoice-total-footer"],[1,"upload-sign"],[1,"form-group","service-upload"],["type","file","multiple",""],["type","text","placeholder","Name of the Signatuaory",1,"form-control"],[1,"form-group","float-end","mb-0"],["type","submit",1,"btn","btn-primary"],["id","invoices_preview","role","dialog",1,"modal","custom-modal","modal-bg","fade","invoices-preview"],[1,"modal-dialog","modal-dialog-centered","modal-xl"],[1,"modal-content"],[1,"modal-body"],[1,"row","justify-content-center"],[1,"col-lg-12"],[1,"card","invoice-info-card"],[1,"card-body","pb-0"],[1,"invoice-item","invoice-item-one"],[1,"invoice-logo","d-flex","justify-content-start"],["src","assets/img/logo-dark.png","alt","logo"],[1,"invoice-head"],[1,"text-primary"],[1,"invoice-item","invoice-item-bg"],[1,"invoice-circle-img"],["src","assets/img/invoice-circle1.png","alt","",1,"invoice-circle1"],["src","assets/img/invoice-circle2.png","alt","",1,"invoice-circle2"],[1,"col-lg-4","col-md-12"],[1,"customer-text-one"],[1,"invoice-name"],[1,"invoice-info","invoice-info-one","border-0"],[1,"invoice-item","invoice-table-wrap"],[1,"invoice-table","table","table-center","mb-0"],[1,"text-end"],[1,"row","align-items-center","justify-content-center"],[1,"invoice-payment-box"],[1,"payment-details"],[1,"invoice-sign-box"],[1,"col-lg-8","col-md-8"],[1,"invoice-terms"],[1,"invoice-terms","mb-0"],[1,"col-lg-4","col-md-4"],[1,"invoice-sign","text-end"],["src","assets/img/signature.png","alt","sign",1,"img-fluid","d-inline-block"],[1,"d-block"],["id","bank_details","role","dialog",1,"modal","custom-modal","modal-bg","fade","bank-details"],[1,"modal-dialog","modal-dialog-centered","modal-lg"],[1,"modal-header"],[1,"form-header","text-start","mb-0"],["type","button","data-bs-dismiss","modal","aria-label","Close",1,"close"],["aria-hidden","true"],[1,"modal-body","text-start"],[1,"bank-inner-details"],["type","text","placeholder","Add Name",1,"form-control"],["type","text","placeholder","Add Bank name",1,"form-control"],["type","text",1,"form-control"],[1,"modal-footer"],[1,"bank-details-btn"],["href","javascript:void(0);","data-bs-dismiss","modal",1,"btn","bank-cancel-btn","me-2"],["href","javascript:void(0);",1,"btn","bank-save-btn"],["id","delete_invoices_details","role","dialog",1,"modal","custom-modal","modal-bg","fade"],[1,"modal-dialog","modal-dialog-centered"],[1,"form-header"],[1,"modal-btn","delete-action"],[1,"col-6"],["href","javascript:void(0);","data-bs-dismiss","modal",1,"btn","btn-primary","paid-continue-btn"],["href","javascript:void(0);","data-bs-dismiss","modal",1,"btn","btn-primary","paid-cancel-btn"],["id","save_invocies_details","role","dialog",1,"modal","custom-modal","modal-bg","fade"],[3,"value"],[1,"add-row"],[1,"add-remove","text-end"],["href","javascript:void(0);",1,"add-btns","me-2",3,"click"],[1,"fas","fa-plus-circle"],["href","javascript:void(0);",1,"copy-btn","me-2"],[1,"fas","fa-copy"],["href","javascript:void(0);",1,"remove-btn"],[1,"fa","fa-trash-alt",3,"click"],[1,"links-info-one"],[1,"links-info"],["class","links-cont",3,"click",4,"ngIf"],[1,"links-cont",3,"click"],["href","javascript:void(0);",1,"service-trash1"],[1,"fa","fa-minus-circle","me-1","mb-3"]],template:function(t,i){if(1&t&&(e.TgZ(0,"div",0)(1,"div",1)(2,"div",2)(3,"div",3)(4,"div",4)(5,"ul",5)(6,"li",6)(7,"a",7),e._UZ(8,"i",8),e._uU(9," Back to Invoice List "),e.qZA()()()(),e.TgZ(10,"div",9)(11,"div",10)(12,"a",11),e._UZ(13,"i",12),e._uU(14," Preview"),e.qZA(),e.TgZ(15,"a",13),e._uU(16," Delete Invoice "),e.qZA(),e.TgZ(17,"a",14),e._uU(18," Save Draft "),e.qZA()()()()(),e.TgZ(19,"div",15)(20,"div",16)(21,"div",17)(22,"div",18)(23,"form",19)(24,"div",20)(25,"div",15)(26,"div",21)(27,"div",22)(28,"label"),e._uU(29,"Customer Name"),e.qZA(),e.TgZ(30,"div",23)(31,"div",24),e.NdJ("click",function(){return i.openCheckBoxes("Customer")}),e.TgZ(32,"p",25),e._uU(33,"Select Customer"),e.qZA(),e.TgZ(34,"span",26),e._UZ(35,"i",27),e.qZA()(),e.TgZ(36,"div",28)(37,"p",29),e._uU(38,"Customer Search"),e.qZA(),e.TgZ(39,"div",30),e._UZ(40,"input",31),e.qZA(),e.TgZ(41,"div",32)(42,"label",33),e._UZ(43,"input",34)(44,"span",35),e._uU(45," Brian Johnson "),e.qZA(),e.TgZ(46,"label",33),e._UZ(47,"input",34)(48,"span",35),e._uU(49," Russell Copeland "),e.qZA(),e.TgZ(50,"label",33),e._UZ(51,"input",34)(52,"span",35),e._uU(53," Greg Lynch "),e.qZA(),e.TgZ(54,"label",33),e._UZ(55,"input",34)(56,"span",35),e._uU(57," John Blair "),e.qZA(),e.TgZ(58,"label",33),e._UZ(59,"input",34)(60,"span",35),e._uU(61," Barbara Moore "),e.qZA(),e.TgZ(62,"label",33),e._UZ(63,"input",34)(64,"span",35),e._uU(65," Hendry Evan "),e.qZA(),e.TgZ(66,"label",33),e._UZ(67,"input",34)(68,"span",35),e._uU(69," Richard Miles "),e.qZA()(),e.TgZ(70,"button",36),e._uU(71,"Apply"),e.qZA(),e.TgZ(72,"button",37),e._uU(73,"Reset"),e.qZA()()()(),e.TgZ(74,"div",22)(75,"label"),e._uU(76,"Po Number"),e.qZA(),e._UZ(77,"input",38),e.qZA()(),e.TgZ(78,"div",39)(79,"h4",40),e._uU(80,"Invoice details"),e.qZA(),e.TgZ(81,"div",41)(82,"div",42)(83,"span"),e._uU(84,"Invoice No. "),e.TgZ(85,"a",7),e._uU(86,"IN093439#@09"),e.qZA()()(),e.TgZ(87,"div",43)(88,"div",3)(89,"div",44)(90,"div",45)(91,"span"),e._uU(92," Date "),e._UZ(93,"input",46)(94,"mat-datepicker",null,47)(96,"mat-datepicker-toggle",48),e.qZA()()(),e.TgZ(97,"div",44)(98,"div",49)(99,"span"),e._uU(100," Due Date "),e._UZ(101,"input",50)(102,"mat-datepicker",null,51)(104,"mat-datepicker-toggle",48),e.qZA()()()()()()(),e.TgZ(105,"div",52)(106,"div",53)(107,"div",54)(108,"label",33),e._UZ(109,"input",55)(110,"span",35),e._uU(111," Enable tax "),e.qZA(),e.TgZ(112,"label",33)(113,"input",56),e.NdJ("click",function(){return i.recurringInvoiceFunc()}),e.qZA(),e._UZ(114,"span",35),e._uU(115," Recurring Invoice "),e.qZA()(),e.TgZ(116,"div",57)(117,"div",15)(118,"div",58)(119,"div",22)(120,"mat-select",59),e.NdJ("ngModelChange",function(d){return i.selectedValue=d}),e.YNc(121,T,2,2,"mat-option",60),e.qZA()()(),e.TgZ(122,"div",58)(123,"div",22),e._UZ(124,"input",61),e.qZA()()()()()()()(),e.TgZ(125,"div",62)(126,"div",15)(127,"div",63)(128,"div",64)(129,"strong",65),e._uU(130,"Invoice From "),e.TgZ(131,"a",66),e._uU(132,"Edit Address"),e.qZA()(),e.TgZ(133,"p",67),e._uU(134," Darren Elder "),e._UZ(135,"br"),e._uU(136," 806 Twin Willow Lane, Old Forge,"),e._UZ(137,"br"),e._uU(138," Newyork, USA "),e._UZ(139,"br"),e.qZA()()(),e.TgZ(140,"div",63)(141,"div",64)(142,"strong",65),e._uU(143,"Invoice To"),e.qZA(),e.TgZ(144,"p",67),e._uU(145," Walter Roberson "),e._UZ(146,"br"),e._uU(147," 299 Star Trek Drive, Panama City, "),e._UZ(148,"br"),e._uU(149," Florida, 32405, USA "),e._UZ(150,"br"),e.qZA()()()()(),e.TgZ(151,"div",68)(152,"h4"),e._uU(153,"Item Details"),e.qZA(),e.TgZ(154,"div",69)(155,"table",70)(156,"thead")(157,"tr")(158,"th"),e._uU(159,"Items"),e.qZA(),e.TgZ(160,"th"),e._uU(161,"Category"),e.qZA(),e.TgZ(162,"th"),e._uU(163,"Quantity"),e.qZA(),e.TgZ(164,"th"),e._uU(165,"Price"),e.qZA(),e.TgZ(166,"th"),e._uU(167,"Amount"),e.qZA(),e.TgZ(168,"th"),e._uU(169,"Discount"),e.qZA(),e.TgZ(170,"th"),e._uU(171,"Actions"),e.qZA()()(),e.TgZ(172,"tbody"),e.YNc(173,b,20,0,"tr",71),e.qZA()()()(),e.TgZ(174,"div",15)(175,"div",72)(176,"div",73)(177,"h4",74),e._uU(178,"More Fields"),e.qZA(),e.TgZ(179,"div",75)(180,"p"),e._uU(181,"Payment Details"),e.qZA(),e.TgZ(182,"a",76),e._UZ(183,"i",77),e._uU(184,"Add Bank Details"),e.qZA()()(),e.TgZ(185,"div",78)(186,"div",79)(187,"div",80)(188,"div",81)(189,"div",82)(190,"p",83)(191,"a",84),e._UZ(192,"i",85),e._uU(193," Add Terms & Conditions "),e.qZA()()(),e.TgZ(194,"div",86)(195,"div",87),e._UZ(196,"textarea",88),e.qZA()()()(),e.TgZ(197,"div",80)(198,"div",81)(199,"div",89)(200,"p",83)(201,"a",90),e._UZ(202,"i",85),e._uU(203," Add Notes "),e.qZA()()(),e.TgZ(204,"div",91)(205,"div",87),e._UZ(206,"textarea",88),e.qZA()()()()()()(),e.TgZ(207,"div",92)(208,"div",93)(209,"h4",94),e._uU(210,"Summary"),e.qZA(),e.TgZ(211,"div",95)(212,"div",96)(213,"p"),e._uU(214,"Taxable Amount "),e.TgZ(215,"span"),e._uU(216,"$21"),e.qZA()(),e.TgZ(217,"p"),e._uU(218,"Round Off "),e._UZ(219,"input",97),e.TgZ(220,"label",98),e._uU(221,"checkbox"),e.qZA(),e.TgZ(222,"span"),e._uU(223,"$54"),e.qZA()(),e.YNc(224,f,3,1,"div",99),e.TgZ(225,"a",100),e.NdJ("click",function(){return i.addCharges()}),e._UZ(226,"i",85),e._uU(227," Additional Charges "),e.qZA(),e.TgZ(228,"div",101)(229,"div",102)(230,"a",103),e._UZ(231,"i",85),e._uU(232," Add more Discount "),e.qZA()()()(),e.TgZ(233,"div",104)(234,"h4"),e._uU(235,"Total Amount "),e.TgZ(236,"span"),e._uU(237,"$ 894.00"),e.qZA()()()()(),e.TgZ(238,"div",105)(239,"div",106)(240,"span"),e._uU(241,"Upload Sign"),e.qZA(),e._UZ(242,"input",107),e.qZA(),e.TgZ(243,"div",22),e._UZ(244,"input",108),e.qZA(),e.TgZ(245,"div",109)(246,"button",110),e._uU(247,"Save Invoice"),e.qZA()()()()()()()()()()()(),e.TgZ(248,"div",111)(249,"div",112)(250,"div",113)(251,"div",114)(252,"div",115)(253,"div",116)(254,"div",117)(255,"div",118)(256,"div",119)(257,"div",15)(258,"div",58)(259,"div",120),e._UZ(260,"img",121),e.qZA()(),e.TgZ(261,"div",58)(262,"div",64)(263,"div",122)(264,"h2",123),e._uU(265,"Invoice"),e.qZA(),e.TgZ(266,"p"),e._uU(267,"Invoice Number : In983248782"),e.qZA()()()()()(),e.TgZ(268,"div",124)(269,"div",125),e._UZ(270,"img",126)(271,"img",127),e.qZA(),e.TgZ(272,"div",15)(273,"div",128)(274,"div",64)(275,"strong",129),e._uU(276,"Billed to"),e.qZA(),e.TgZ(277,"h6",130),e._uU(278,"Customer Name"),e.qZA(),e.TgZ(279,"p",67),e._uU(280," 9087484288 "),e._UZ(281,"br"),e._uU(282," Address line 1, "),e._UZ(283,"br"),e._uU(284," Address line 2 "),e._UZ(285,"br"),e._uU(286," Zip code ,City - Country "),e.qZA()()(),e.TgZ(287,"div",128)(288,"div",64)(289,"strong",129),e._uU(290,"Invoice From"),e.qZA(),e.TgZ(291,"h6",130),e._uU(292,"Company Name"),e.qZA(),e.TgZ(293,"p",67),e._uU(294," 9087484288 "),e._UZ(295,"br"),e._uU(296," Address line 1, "),e._UZ(297,"br"),e._uU(298," Address line 2 "),e._UZ(299,"br"),e._uU(300," Zip code ,City - Country "),e.qZA()()(),e.TgZ(301,"div",128)(302,"div",131)(303,"p"),e._uU(304,"Issue Date : 27 Jul 2022"),e.qZA(),e.TgZ(305,"p"),e._uU(306,"Due Date : 27 Aug 2022"),e.qZA(),e.TgZ(307,"p"),e._uU(308,"Due Amount : $ 1,54,22 "),e.qZA(),e.TgZ(309,"p"),e._uU(310,"Recurring Invoice : 15 Months"),e.qZA(),e.TgZ(311,"p",25),e._uU(312,"PO Number : 54515454"),e.qZA()()()()(),e.TgZ(313,"div",132)(314,"div",15)(315,"div",16)(316,"div",69)(317,"table",133)(318,"thead")(319,"tr")(320,"th"),e._uU(321,"Description"),e.qZA(),e.TgZ(322,"th"),e._uU(323,"Category"),e.qZA(),e.TgZ(324,"th"),e._uU(325,"Rate/Item"),e.qZA(),e.TgZ(326,"th"),e._uU(327,"Quantity"),e.qZA(),e.TgZ(328,"th"),e._uU(329,"Discount (%)"),e.qZA(),e.TgZ(330,"th",134),e._uU(331,"Amount"),e.qZA()()(),e.TgZ(332,"tbody")(333,"tr")(334,"td"),e._uU(335,"Dell Laptop"),e.qZA(),e.TgZ(336,"td"),e._uU(337,"Laptop"),e.qZA(),e.TgZ(338,"td"),e._uU(339,"$1,110"),e.qZA(),e.TgZ(340,"td"),e._uU(341,"2"),e.qZA(),e.TgZ(342,"td"),e._uU(343,"2%"),e.qZA(),e.TgZ(344,"td",134),e._uU(345,"$400"),e.qZA()(),e.TgZ(346,"tr")(347,"td"),e._uU(348,"HP Laptop"),e.qZA(),e.TgZ(349,"td"),e._uU(350,"Laptop"),e.qZA(),e.TgZ(351,"td"),e._uU(352,"$1,500"),e.qZA(),e.TgZ(353,"td"),e._uU(354,"3"),e.qZA(),e.TgZ(355,"td"),e._uU(356,"6%"),e.qZA(),e.TgZ(357,"td",134),e._uU(358,"$3,000"),e.qZA()(),e.TgZ(359,"tr")(360,"td"),e._uU(361,"Apple Ipad"),e.qZA(),e.TgZ(362,"td"),e._uU(363,"Ipad"),e.qZA(),e.TgZ(364,"td"),e._uU(365,"$11,500"),e.qZA(),e.TgZ(366,"td"),e._uU(367,"1"),e.qZA(),e.TgZ(368,"td"),e._uU(369,"10%"),e.qZA(),e.TgZ(370,"td",134),e._uU(371,"$11,000"),e.qZA()()()()()()()(),e.TgZ(372,"div",135)(373,"div",44)(374,"div",136)(375,"h4"),e._uU(376,"Payment Details"),e.qZA(),e.TgZ(377,"div",137)(378,"p"),e._uU(379,"Debit Card XXXXXXXXXXXX-2541 HDFC Bank"),e.qZA()()()(),e.TgZ(380,"div",44)(381,"div",93)(382,"div",95)(383,"div",96)(384,"p"),e._uU(385,"Taxable "),e.TgZ(386,"span"),e._uU(387,"$6,660.00"),e.qZA()(),e.TgZ(388,"p"),e._uU(389,"Additional Charges "),e.TgZ(390,"span"),e._uU(391,"$6,660.00"),e.qZA()(),e.TgZ(392,"p"),e._uU(393,"Discount "),e.TgZ(394,"span"),e._uU(395,"$3,300.00"),e.qZA()(),e.TgZ(396,"p",25),e._uU(397,"Sub total "),e.TgZ(398,"span"),e._uU(399,"$3,300.00"),e.qZA()()(),e.TgZ(400,"div",104)(401,"h4"),e._uU(402,"Total Amount "),e.TgZ(403,"span"),e._uU(404,"$143,300.00"),e.qZA()()()()()()(),e.TgZ(405,"div",138)(406,"div",15)(407,"div",139)(408,"div",140)(409,"h6"),e._uU(410,"Notes:"),e.qZA(),e.TgZ(411,"p",25),e._uU(412,"Enter customer notes or any other details"),e.qZA()(),e.TgZ(413,"div",141)(414,"h6"),e._uU(415,"Terms and Conditions:"),e.qZA(),e.TgZ(416,"p",25),e._uU(417,"Enter customer notes or any other details"),e.qZA()()(),e.TgZ(418,"div",142)(419,"div",143),e._UZ(420,"img",144),e.TgZ(421,"span",145),e._uU(422,"Harristemp"),e.qZA()()()()()()()()()()()()(),e.TgZ(423,"div",146)(424,"div",147)(425,"div",113)(426,"div",148)(427,"div",149)(428,"h4",25),e._uU(429,"Add Bank Details"),e.qZA()(),e.TgZ(430,"button",150)(431,"span",151),e._uU(432,"\xd7"),e.qZA()()(),e.TgZ(433,"div",152)(434,"div",153)(435,"div",15)(436,"div",44)(437,"div",22)(438,"label"),e._uU(439,"Account Holder Name"),e.qZA(),e._UZ(440,"input",154),e.qZA()(),e.TgZ(441,"div",44)(442,"div",22)(443,"label"),e._uU(444,"Bank name"),e.qZA(),e._UZ(445,"input",155),e.qZA()(),e.TgZ(446,"div",44)(447,"div",22)(448,"label"),e._uU(449,"IFSC Code"),e.qZA(),e._UZ(450,"input",156),e.qZA()(),e.TgZ(451,"div",44)(452,"div",22)(453,"label"),e._uU(454,"Account Number"),e.qZA(),e._UZ(455,"input",156),e.qZA()()()()(),e.TgZ(456,"div",157)(457,"div",158)(458,"a",159),e._uU(459,"Cancel"),e.qZA(),e.TgZ(460,"a",160),e._uU(461,"Save Item"),e.qZA()()()()()(),e.TgZ(462,"div",161)(463,"div",162)(464,"div",113)(465,"div",114)(466,"div",163)(467,"h3"),e._uU(468,"Delete Invoice Details"),e.qZA(),e.TgZ(469,"p"),e._uU(470,"Are you sure want to delete?"),e.qZA()(),e.TgZ(471,"div",164)(472,"div",15)(473,"div",165)(474,"a",166),e._uU(475,"Delete"),e.qZA()(),e.TgZ(476,"div",165)(477,"a",167),e._uU(478,"Cancel"),e.qZA()()()()()()()(),e.TgZ(479,"div",168)(480,"div",162)(481,"div",113)(482,"div",114)(483,"div",163)(484,"h3"),e._uU(485,"Save Invoice Details"),e.qZA(),e.TgZ(486,"p"),e._uU(487,"Are you sure want to save?"),e.qZA()(),e.TgZ(488,"div",164)(489,"div",15)(490,"div",165)(491,"a",166),e._uU(492,"Save"),e.qZA()(),e.TgZ(493,"div",165)(494,"a",167),e._uU(495,"Cancel"),e.qZA()()()()()()()()),2&t){const n=e.MAs(95),d=e.MAs(103);e.xp6(7),e.Q6J("routerLink",i.routes.allInvoice),e.xp6(29),e.Q6J("ngClass","Customer"===i.checkboxes[0]?"d-block":"d-none"),e.xp6(49),e.Q6J("routerLink",i.routes.viewInvoice),e.xp6(8),e.Q6J("formControl",i.date)("matDatepicker",n),e.xp6(3),e.Q6J("for",n),e.xp6(5),e.Q6J("matDatepicker",d),e.xp6(3),e.Q6J("for",d),e.xp6(12),e.Q6J("ngClass",i.recurringInvoice?"d-block":"d-none"),e.xp6(4),e.Q6J("ngModel",i.selectedValue)("ngModelOptions",e.DdM(15,q)),e.xp6(1),e.Q6J("ngForOf",i.selecedList),e.xp6(10),e.Q6J("routerLink",i.routes.editInvoices),e.xp6(42),e.Q6J("ngForOf",i.itemDetails),e.xp6(51),e.Q6J("ngForOf",i.chargesArray)}},dependencies:[Z.mk,Z.sg,Z.O5,v.rH,u.Mq,u.hl,u.nW,_.R9,A.gD,U.ey,l._Y,l.Fj,l.JJ,l.JL,l.On,l.F,l.oH]});const k=[{path:"",component:s}];class c{}c.\u0275fac=function(t){return new(t||c)},c.\u0275mod=e.oAB({type:c}),c.\u0275inj=e.cJS({imports:[v.Bz.forChild(k),v.Bz]});var y=a(9079);class r{}r.\u0275fac=function(t){return new(t||r)},r.\u0275mod=e.oAB({type:r}),r.\u0275inj=e.cJS({imports:[Z.ez,c,y.m]})}}]);
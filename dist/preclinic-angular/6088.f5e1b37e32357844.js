"use strict";(self.webpackChunkpreclinic_angular=self.webpackChunkpreclinic_angular||[]).push([[6088],{6088:(x,m,n)=>{n.r(m),n.d(m,{ScheduleModule:()=>l});var g=n(6895),h=n(27),v=n(7155),f=n(6382),e=n(4650),b=n(7945),_=n(6308),u=n(433);const T=function(s,a){return{"status-green":s,"status-pink":a}};function A(s,a){if(1&s&&(e.TgZ(0,"tr")(1,"td")(2,"div",36),e._UZ(3,"input",37),e.qZA()(),e.TgZ(4,"td",53)(5,"a",7),e._UZ(6,"img",54),e._uU(7),e.qZA()(),e.TgZ(8,"td"),e._uU(9),e.qZA(),e.TgZ(10,"td"),e._uU(11),e.qZA(),e.TgZ(12,"td"),e._uU(13),e.qZA(),e.TgZ(14,"td")(15,"button",55),e._uU(16),e.qZA()(),e.TgZ(17,"td",56)(18,"div",57)(19,"a",58),e._UZ(20,"i",59),e.qZA(),e.TgZ(21,"div",60)(22,"a",61),e._UZ(23,"i",62),e._uU(24," Edit"),e.qZA(),e.TgZ(25,"a",63),e._UZ(26,"i",64),e._uU(27," Delete"),e.qZA()()()()()),2&s){const t=a.$implicit,r=e.oxw();e.xp6(5),e.Q6J("routerLink",r.routes.profile),e.xp6(1),e.Q6J("src",t.img,e.LSH),e.xp6(1),e.hij(" ",t.doctorName,""),e.xp6(2),e.Oqu(t.department),e.xp6(2),e.Oqu(t.availableDays),e.xp6(2),e.hij("",t.availableTime,"\t"),e.xp6(2),e.Q6J("ngClass",e.WLB(9,T,"Active"===t.status,"In Active"===t.status)),e.xp6(1),e.Oqu(t.status),e.xp6(6),e.Q6J("routerLink",r.routes.editSchedule)}}function S(s,a){if(1&s){const t=e.EpF();e.TgZ(0,"li",66),e.NdJ("click",function(){e.CHM(t);const i=e.oxw(2);return e.KtG(i.moveToPage(i.currentPage-2))}),e.TgZ(1,"a",67),e._uU(2," ... "),e.qZA()()}if(2&s){const t=e.oxw(2);e.Q6J("hidden",1===t.currentPage)}}function y(s,a){if(1&s){const t=e.EpF();e.TgZ(0,"li",66),e.NdJ("click",function(){e.CHM(t);const i=e.oxw(2);return e.KtG(i.moveToPage(i.currentPage+2))}),e.TgZ(1,"a",67),e._uU(2," ... "),e.qZA()()}if(2&s){const t=e.oxw(2);e.Q6J("hidden",t.currentPage>=t.pageNumberArray[t.pageNumberArray.length-2]||t.totalData<t.serialNumberArray[t.serialNumberArray.length-1])}}function k(s,a){if(1&s){const t=e.EpF();e.ynx(0),e.TgZ(1,"li",50)(2,"a",52),e.NdJ("click",function(){const d=e.CHM(t).$implicit,p=e.oxw();return e.KtG(p.moveToPage(d))}),e._uU(3),e.qZA()(),e.YNc(4,S,3,1,"li",65),e.YNc(5,y,3,1,"li",65),e.BQk()}if(2&s){const t=a.$implicit,r=a.index,i=e.oxw();e.xp6(1),e.ekj("active",t===i.currentPage),e.Q6J("ngClass",i.pageNumberArray[i.currentPage-2]>t&&1!==t&&i.pageNumberArray.length>6||i.pageNumberArray[i.currentPage]<t&&1!==t&&i.pageNumberArray.length>6&&i.pageNumberArray.length!==t?"hide-page-no":"show-page-no"),e.xp6(2),e.hij(" ",t," "),e.xp6(1),e.Q6J("ngIf",0===r&&i.pageNumberArray.length>6&&i.currentPage>2),e.xp6(1),e.Q6J("ngIf",r===i.pageNumberArray.length-2&&i.pageNumberArray.length>6)}}const Z=function(s){return{disabled:s}};class c{constructor(a){this.data=a,this.routes=f._,this.schedule=[],this.showFilter=!1,this.searchDataValue="",this.lastIndex=0,this.pageSize=10,this.totalData=0,this.skip=0,this.limit=this.pageSize,this.pageIndex=0,this.serialNumberArray=[],this.currentPage=1,this.pageNumberArray=[],this.pageSelection=[],this.totalPages=0}ngOnInit(){this.getTableData()}getTableData(){this.schedule=[],this.serialNumberArray=[],this.data.getSchedule().subscribe(a=>{this.totalData=a.totalData,a.data.map((t,r)=>{const i=r+1;r>=this.skip&&i<=this.limit&&(this.schedule.push(t),this.serialNumberArray.push(i))}),this.dataSource=new v.by(this.schedule),this.calculateTotalPages(this.totalData,this.pageSize)})}searchData(a){this.dataSource.filter=a.trim().toLowerCase(),this.schedule=this.dataSource.filteredData}sortData(a){const t=this.schedule.slice();this.schedule=a.active&&""!==a.direction?t.sort((r,i)=>(r[a.active]<i[a.active]?-1:1)*("asc"===a.direction?1:-1)):t}getMoreData(a){"next"==a?(this.currentPage++,this.pageIndex=this.currentPage-1,this.limit+=this.pageSize,this.skip=this.pageSize*this.pageIndex,this.getTableData()):"previous"==a&&(this.currentPage--,this.pageIndex=this.currentPage-1,this.limit-=this.pageSize,this.skip=this.pageSize*this.pageIndex,this.getTableData())}moveToPage(a){this.currentPage=a,this.skip=this.pageSelection[a-1].skip,this.limit=this.pageSelection[a-1].limit,a>this.currentPage?this.pageIndex=a-1:a<this.currentPage&&(this.pageIndex=a+1),this.getTableData()}PageSize(){this.pageSelection=[],this.limit=this.pageSize,this.skip=0,this.currentPage=1,this.getTableData()}calculateTotalPages(a,t){this.pageNumberArray=[],this.totalPages=a/t,this.totalPages%1!=0&&(this.totalPages=Math.trunc(this.totalPages+1));for(var r=1;r<=this.totalPages;r++){const i=t*r,d=i-t;this.pageNumberArray.push(r),this.pageSelection.push({skip:d,limit:i})}}}c.\u0275fac=function(a){return new(a||c)(e.Y36(b.D))},c.\u0275cmp=e.Xpm({type:c,selectors:[["app-schedule"]],decls:76,vars:14,consts:[[1,"page-wrapper"],[1,"content"],[1,"page-header"],[1,"row"],[1,"col-sm-12"],[1,"breadcrumb"],[1,"breadcrumb-item"],[3,"routerLink"],[1,"feather","icon-chevron-right"],[1,"breadcrumb-item","active"],[1,"card","card-table","show-entire"],[1,"card-body"],[1,"page-table-header","mb-2"],[1,"row","align-items-center"],[1,"col"],[1,"doctor-table-blk"],[1,"doctor-search-blk"],[1,"top-nav-search","table-search-blk"],["placeholder","Search here",1,"form-control",3,"ngModel","ngModelChange"],[1,"btn"],["src","assets/img/icons/search-normal.svg","alt",""],[1,"add-group"],[1,"btn","btn-primary","add-pluss","ms-2",3,"routerLink"],["src","assets/img/icons/plus.svg","alt",""],["href","javascript:;",1,"btn","btn-primary","doctor-refresh","ms-2"],["src","assets/img/icons/re-fresh.svg","alt",""],[1,"col-auto","text-end","float-end","ms-auto","download-grp"],["href","javascript:;",1,"me-2"],["src","assets/img/icons/pdf-icon-01.svg","alt",""],["src","assets/img/icons/pdf-icon-02.svg","alt",""],["src","assets/img/icons/pdf-icon-03.svg","alt",""],["href","javascript:;"],["src","assets/img/icons/pdf-icon-04.svg","alt",""],[1,"table-responsive"],["matSort","",1,"table","border-0","custom-table","comman-table","datatable","mb-0",3,"matSortChange"],["mat-sort-header","checkbox"],[1,"form-check","check-tables"],["type","checkbox","value","something",1,"form-check-input"],["mat-sort-header","doctorName"],["mat-sort-header","department"],["mat-sort-header","availableDays"],["mat-sort-header","availableTime"],["mat-sort-header","status"],[4,"ngFor","ngForOf"],[1,"table_footer"],[1,"col-sm-12","col-md-5"],[1,"dataTables_info"],[1,"col-sm-12","col-md-7"],[1,"pagination_section"],[1,"pagination"],[1,"page-item",3,"ngClass"],["href","javascript:void(0);","tabindex","-1",1,"page-link",3,"click"],["href","javascript:void(0);",1,"page-link",3,"click"],[1,"profile-image"],["width","28","height","28","alt","",1,"rounded-circle","m-r-5",3,"src"],[1,"custom-badge",3,"ngClass"],[1,"text-end"],[1,"dropdown","dropdown-action"],["href","javascript:void(0);","data-bs-toggle","dropdown","aria-expanded","false",1,"action-icon","dropdown-toggle"],[1,"fa","fa-ellipsis-v"],[1,"dropdown-menu","dropdown-menu-end"],[1,"dropdown-item",3,"routerLink"],[1,"fa-solid","fa-pen-to-square","m-r-5"],["href","javascript:void(0);","data-bs-toggle","modal","data-bs-target","#delete_patient",1,"dropdown-item"],[1,"fa","fa-trash-alt","m-r-5"],["class","page-item",3,"hidden","click",4,"ngIf"],[1,"page-item",3,"hidden","click"],["href","javascript:void(0);",1,"page-link"]],template:function(a,t){1&a&&(e.TgZ(0,"div",0)(1,"div",1)(2,"div",2)(3,"div",3)(4,"div",4)(5,"ul",5)(6,"li",6)(7,"a",7),e._uU(8,"Doctor Shedule "),e.qZA()(),e.TgZ(9,"li",6),e._UZ(10,"i",8),e.qZA(),e.TgZ(11,"li",9),e._uU(12,"Schedule List"),e.qZA()()()()(),e.TgZ(13,"div",3)(14,"div",4)(15,"div",10)(16,"div",11)(17,"div",12)(18,"div",13)(19,"div",14)(20,"div",15)(21,"h3"),e._uU(22,"Schedule List"),e.qZA(),e.TgZ(23,"div",16)(24,"div",17)(25,"input",18),e.NdJ("ngModelChange",function(i){return t.searchDataValue=i})("ngModelChange",function(){return t.searchData(t.searchDataValue)}),e.qZA(),e.TgZ(26,"a",19),e._UZ(27,"img",20),e.qZA()(),e.TgZ(28,"div",21)(29,"a",22),e._UZ(30,"img",23),e.qZA(),e.TgZ(31,"a",24),e._UZ(32,"img",25),e.qZA()()()()(),e.TgZ(33,"div",26)(34,"a",27),e._UZ(35,"img",28),e.qZA(),e.TgZ(36,"a",27),e._UZ(37,"img",29),e.qZA(),e.TgZ(38,"a",27),e._UZ(39,"img",30),e.qZA(),e.TgZ(40,"a",31),e._UZ(41,"img",32),e.qZA()()()(),e.TgZ(42,"div",33)(43,"table",34),e.NdJ("matSortChange",function(i){return t.sortData(i)}),e.TgZ(44,"thead")(45,"tr")(46,"th",35)(47,"div",36),e._UZ(48,"input",37),e.qZA()(),e.TgZ(49,"th",38),e._uU(50,"Doctor Name"),e.qZA(),e.TgZ(51,"th",39),e._uU(52,"Department"),e.qZA(),e.TgZ(53,"th",40),e._uU(54,"Available Days"),e.qZA(),e.TgZ(55,"th",41),e._uU(56,"Available Time"),e.qZA(),e.TgZ(57,"th",42),e._uU(58,"Status"),e.qZA(),e._UZ(59,"th"),e.qZA()(),e.TgZ(60,"tbody"),e.YNc(61,A,28,12,"tr",43),e.qZA()(),e.TgZ(62,"div",44)(63,"div",45)(64,"div",46),e._uU(65),e.qZA()(),e.TgZ(66,"div",47)(67,"div",48)(68,"ul",49)(69,"li",50)(70,"a",51),e.NdJ("click",function(){return t.getMoreData("previous")}),e._uU(71,"Previous"),e.qZA()(),e.YNc(72,k,6,6,"ng-container",43),e.TgZ(73,"li",50)(74,"a",52),e.NdJ("click",function(){return t.getMoreData("next")}),e._uU(75,"Next "),e.qZA()()()()()()()()()()()()()),2&a&&(e.xp6(7),e.Q6J("routerLink",t.routes.schedule),e.xp6(18),e.Q6J("ngModel",t.searchDataValue),e.xp6(4),e.Q6J("routerLink",t.routes.addSchedule),e.xp6(32),e.Q6J("ngForOf",t.schedule),e.xp6(4),e.lnq(" Showing ",t.serialNumberArray[0]," to ",t.serialNumberArray[t.serialNumberArray.length-1]," of ",t.totalData," entries "),e.xp6(4),e.Q6J("ngClass",e.VKq(10,Z,1===t.currentPage)),e.xp6(3),e.Q6J("ngForOf",t.pageNumberArray),e.xp6(1),e.Q6J("ngClass",e.VKq(12,Z,t.currentPage===t.pageNumberArray[t.pageNumberArray.length-1]||0===t.schedule.length)))},dependencies:[g.mk,g.sg,g.O5,h.rH,_.YE,_.nU,u.Fj,u.JJ,u.On]});const C=[{path:"",component:c}];class o{}o.\u0275fac=function(a){return new(a||o)},o.\u0275mod=e.oAB({type:o}),o.\u0275inj=e.cJS({imports:[h.Bz.forChild(C),h.Bz]});var U=n(9079);class l{}l.\u0275fac=function(a){return new(a||l)},l.\u0275mod=e.oAB({type:l}),l.\u0275inj=e.cJS({imports:[g.ez,o,U.m]})}}]);
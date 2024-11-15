"use strict";(self.webpackChunkpreclinic_angular=self.webpackChunkpreclinic_angular||[]).push([[8615],{8615:(H,T,l)=>{l.r(T),l.d(T,{RolesModule:()=>g});var c=l(6895),p=l(27),e=l(4650);class h{}h.\u0275fac=function(i){return new(i||h)},h.\u0275cmp=e.Xpm({type:h,selectors:[["app-roles"]],decls:1,vars:0,template:function(i,t){1&i&&e._UZ(0,"router-outlet")},dependencies:[p.lC]});var A=l(7945),_=l(529),v=l(5862),x=l(866);class d{constructor(i,t){this.http=i,this.authService=t}listRoles(){let i=new _.WM({Authorization:"Bearer "+this.authService.token});return this.http.get(v.$g+"/roles",{headers:i})}showRoles(i){let t=new _.WM({Authorization:"Bearer "+this.authService.token});return this.http.get(v.$g+"/roles/"+i,{headers:t})}storeRoles(i){let t=new _.WM({Authorization:"Bearer "+this.authService.token});return this.http.post(v.$g+"/roles",i,{headers:t})}editRoles(i,t){let n=new _.WM({Authorization:"Bearer "+this.authService.token});return this.http.put(v.$g+"/roles/"+t,i,{headers:n})}deleteRoles(i){let t=new _.WM({Authorization:"Bearer "+this.authService.token});return this.http.delete(v.$g+"/roles/"+i,{headers:t})}}d.\u0275fac=function(i){return new(i||d)(e.LFG(_.eN),e.LFG(x.e))},d.\u0275prov=e.Yz7({token:d,factory:d.\u0275fac,providedIn:"root"});var r=l(433);function R(s,i){1&s&&(e.TgZ(0,"div",15)(1,"div",26)(2,"div",27)(3,"strong"),e._uU(4,"Error!"),e.qZA(),e._uU(5," ES NECESARIO LLENAR UN NOMBRE Y SELECCIONAR UN PERMISO. "),e.TgZ(6,"button",28),e._UZ(7,"span",29),e.qZA()()()())}function C(s,i){1&s&&(e.TgZ(0,"div",15)(1,"div",26)(2,"div",30)(3,"strong"),e._uU(4,"Exito!"),e.qZA(),e._uU(5," EL ROL SE CREO CORRECTAMENTE. "),e.TgZ(6,"button",28),e._UZ(7,"span",29),e.qZA()()()())}function q(s,i){if(1&s&&(e.TgZ(0,"div",15)(1,"div",26)(2,"div",31)(3,"strong"),e._uU(4,"!"),e.qZA(),e._uU(5),e.TgZ(6,"button",28),e._UZ(7,"span",29),e.qZA()()()()),2&s){const t=e.oxw();e.xp6(5),e.hij(" ",t.text_validation,". ")}}function k(s,i){if(1&s){const t=e.EpF();e.ynx(0),e.TgZ(1,"div",34)(2,"label")(3,"input",35),e.NdJ("click",function(){const a=e.CHM(t).$implicit,m=e.oxw(3);return e.KtG(m.addPermission(a))}),e.qZA(),e._uU(4),e.qZA()(),e.BQk()}if(2&s){const t=i.$implicit;e.xp6(4),e.hij(" ",t.menuValue," ")}}function N(s,i){if(1&s&&(e.TgZ(0,"div",33),e.YNc(1,k,5,1,"ng-container",25),e.qZA()),2&s){const t=e.oxw().$implicit;e.xp6(1),e.Q6J("ngForOf",t.subMenus)}}function w(s,i){if(1&s){const t=e.EpF();e.TgZ(0,"div",33)(1,"div",34)(2,"label")(3,"input",35),e.NdJ("click",function(){e.CHM(t);const o=e.oxw().$implicit,a=e.oxw();return e.KtG(a.addPermission(o))}),e.qZA(),e._uU(4),e.qZA()()()}if(2&s){const t=e.oxw().$implicit;e.xp6(4),e.hij(" ",t.menuValue," ")}}function y(s,i){if(1&s&&(e.ynx(0),e.TgZ(1,"tr")(2,"td"),e._uU(3),e.qZA(),e.TgZ(4,"td"),e.YNc(5,N,2,1,"div",32),e.YNc(6,w,5,1,"div",32),e.qZA()(),e.BQk()),2&s){const t=i.$implicit;e.xp6(3),e.Oqu(t.menuValue),e.xp6(2),e.Q6J("ngIf",t.subMenus&&t.subMenus.length>0),e.xp6(1),e.Q6J("ngIf",t.subMenus&&0==t.subMenus.length)}}class f{constructor(i,t){this.DataService=i,this.RoleService=t,this.sideBar=[],this.name="",this.permissions=[],this.valid_form=!1,this.valid_form_success=!1,this.text_validation=null}ngOnInit(){this.sideBar=this.DataService.sideBar[0].menu}addPermission(i){if(i.permision){let t=this.permissions.findIndex(n=>n==i.permision);-1!=t?this.permissions.splice(t,1):this.permissions.push(i.permision),console.log(this.permissions)}}save(){if(this.valid_form=!1,!this.name||0==this.permissions.length)return void(this.valid_form=!0);let i={name:this.name,permisions:this.permissions};this.valid_form_success=!1,this.text_validation=null,this.RoleService.storeRoles(i).subscribe(t=>{if(console.log(t),403==t.message)this.text_validation=t.message_text;else{this.name="",this.permissions=[],this.valid_form_success=!0;let n=this.sideBar;this.sideBar=[],setTimeout(()=>{this.sideBar=n},50)}})}}f.\u0275fac=function(i){return new(i||f)(e.Y36(A.D),e.Y36(d))},f.\u0275cmp=e.Xpm({type:f,selectors:[["app-add-role-user"]],decls:46,vars:5,consts:[[1,"page-wrapper"],[1,"content"],[1,"page-header"],[1,"row"],[1,"col-sm-12"],[1,"breadcrumb"],[1,"breadcrumb-item"],["href","#"],[1,"feather","icon-chevron-right"],[1,"breadcrumb-item","active"],[1,"row","justify-content-center"],[1,"col-lg-8"],[1,"card-box"],[1,"card-title"],["action","#"],[1,"form-group","row"],[1,"col-form-label","col-md-2"],[1,"col-md-10"],["type","text","name","name",1,"form-control",3,"ngModel","ngModelChange"],[1,"col-md-12","text-end"],[1,"btn","btn-primary",3,"click"],["class","form-group row",4,"ngIf"],[1,"card-block"],[1,"table-responsive"],[1,"table","table-bordered","mb-0"],[4,"ngFor","ngForOf"],[1,"col-md-8"],["role","alert",1,"alert","alert-danger","alert-dismissible","fade","show"],["type","button","data-bs-dismiss","alert","aria-label","Close",1,"btn-close"],["aria-hidden","true"],["role","alert",1,"alert","alert-success","alert-dismissible","fade","show"],["role","alert",1,"alert","alert-warning","alert-dismissible","fade","show"],["class","",4,"ngIf"],[1,""],[1,"checkbox"],["type","checkbox","name","checkbox",3,"click"]],template:function(i,t){1&i&&(e.TgZ(0,"div",0)(1,"div",1)(2,"div",2)(3,"div",3)(4,"div",4)(5,"ul",5)(6,"li",6)(7,"a",7),e._uU(8,"Roles y Permisos "),e.qZA()(),e.TgZ(9,"li",6),e._UZ(10,"i",8),e.qZA(),e.TgZ(11,"li",9),e._uU(12,"Registro"),e.qZA()()()()(),e.TgZ(13,"div",10)(14,"div",11)(15,"div",12)(16,"h4",13),e._uU(17,"Creaci\xf3n Rol"),e.qZA(),e.TgZ(18,"form",14)(19,"div",15)(20,"label",16),e._uU(21,"Nombre"),e.qZA(),e.TgZ(22,"div",17)(23,"input",18),e.NdJ("ngModelChange",function(o){return t.name=o}),e.qZA()()(),e.TgZ(24,"div",15)(25,"div",19)(26,"button",20),e.NdJ("click",function(){return t.save()}),e._uU(27,"GUARDAR"),e.qZA()()(),e.YNc(28,R,8,0,"div",21),e.YNc(29,C,8,0,"div",21),e.YNc(30,q,8,1,"div",21),e.qZA()()(),e.TgZ(31,"div",11)(32,"div",12)(33,"h4",13),e._uU(34,"Asignaci\xf3n de Permisos"),e.qZA(),e.TgZ(35,"div",22)(36,"div",23)(37,"table",24)(38,"thead")(39,"tr")(40,"th"),e._uU(41,"Secci\xf3n"),e.qZA(),e.TgZ(42,"th"),e._uU(43,"Permisos"),e.qZA()()(),e.TgZ(44,"tbody"),e.YNc(45,y,7,3,"ng-container",25),e.qZA()()()()()()()()()),2&i&&(e.xp6(23),e.Q6J("ngModel",t.name),e.xp6(5),e.Q6J("ngIf",t.valid_form),e.xp6(1),e.Q6J("ngIf",t.valid_form_success),e.xp6(1),e.Q6J("ngIf",t.text_validation),e.xp6(15),e.Q6J("ngForOf",t.sideBar))},dependencies:[c.sg,c.O5,r._Y,r.Fj,r.JJ,r.JL,r.On,r.F]});var E=l(7155);const S=function(s){return["/roles/list/edit/",s]};function J(s,i){if(1&s&&(e.TgZ(0,"a",65),e._UZ(1,"i",66),e._uU(2," Edit"),e.qZA()),2&s){const t=e.oxw(2).$implicit;e.Q6J("routerLink",e.VKq(1,S,t.id))}}function L(s,i){if(1&s){const t=e.EpF();e.TgZ(0,"a",67),e.NdJ("click",function(){e.CHM(t);const o=e.oxw(2).$implicit,a=e.oxw();return e.KtG(a.selectRole(o))}),e._UZ(1,"i",68),e._uU(2," Delete"),e.qZA()}if(2&s){const t=e.oxw(2).$implicit;e.uIk("data-bs-target","#delete_patient-"+t.id)}}function M(s,i){if(1&s&&(e.TgZ(0,"div",59)(1,"a",60),e._UZ(2,"i",61),e.qZA(),e.TgZ(3,"div",62),e.YNc(4,J,3,3,"a",63),e.YNc(5,L,3,1,"a",64),e.qZA()()),2&s){const t=e.oxw(2);e.xp6(4),e.Q6J("ngIf",t.isPermision("edit_rol")),e.xp6(1),e.Q6J("ngIf",t.isPermision("delete_rol"))}}function I(s,i){if(1&s&&(e.TgZ(0,"h3"),e._uU(1),e.qZA()),2&s){const t=e.oxw(2);e.xp6(1),e.hij("Are you sure want to delete this role ",t.role_selected.name,"?")}}function P(s,i){if(1&s){const t=e.EpF();e.TgZ(0,"tr")(1,"td"),e._uU(2),e.qZA(),e.TgZ(3,"td"),e._uU(4),e.qZA(),e.TgZ(5,"td"),e._uU(6),e.qZA(),e.TgZ(7,"td",48),e.YNc(8,M,6,2,"div",49),e.qZA(),e.TgZ(9,"div",50)(10,"div",51)(11,"div",52)(12,"div",53),e._UZ(13,"img",54),e.YNc(14,I,2,1,"h3",55),e.TgZ(15,"div",56)(16,"a",57),e._uU(17,"Close"),e.qZA(),e.TgZ(18,"button",58),e.NdJ("click",function(){e.CHM(t);const o=e.oxw();return e.KtG(o.deleteRol())}),e._uU(19,"Delete"),e.qZA()()()()()()()}if(2&s){const t=i.$implicit,n=e.oxw();e.xp6(2),e.Oqu(t.name),e.xp6(2),e.Oqu(t.permision_pluck.length>0?t.permision_pluck:"TODOS LOS PERMISOS"),e.xp6(2),e.Oqu(t.created_at),e.xp6(2),e.Q6J("ngIf",1!=t.id),e.xp6(1),e.uIk("id","delete_patient-"+t.id),e.xp6(5),e.Q6J("ngIf",n.role_selected)}}function F(s,i){if(1&s){const t=e.EpF();e.TgZ(0,"li",70),e.NdJ("click",function(){e.CHM(t);const o=e.oxw(2);return e.KtG(o.moveToPage(o.currentPage-2))}),e.TgZ(1,"a",71),e._uU(2," ... "),e.qZA()()}if(2&s){const t=e.oxw(2);e.Q6J("hidden",1===t.currentPage)}}function D(s,i){if(1&s){const t=e.EpF();e.TgZ(0,"li",70),e.NdJ("click",function(){e.CHM(t);const o=e.oxw(2);return e.KtG(o.moveToPage(o.currentPage+2))}),e.TgZ(1,"a",71),e._uU(2," ... "),e.qZA()()}if(2&s){const t=e.oxw(2);e.Q6J("hidden",t.currentPage>=t.pageNumberArray[t.pageNumberArray.length-2]||t.totalData<t.serialNumberArray[t.serialNumberArray.length-1])}}function O(s,i){if(1&s){const t=e.EpF();e.ynx(0),e.TgZ(1,"li",45)(2,"a",47),e.NdJ("click",function(){const a=e.CHM(t).$implicit,m=e.oxw();return e.KtG(m.moveToPage(a))}),e._uU(3),e.qZA()(),e.YNc(4,F,3,1,"li",69),e.YNc(5,D,3,1,"li",69),e.BQk()}if(2&s){const t=i.$implicit,n=i.index,o=e.oxw();e.xp6(1),e.ekj("active",t===o.currentPage),e.Q6J("ngClass",o.pageNumberArray[o.currentPage-2]>t&&1!==t&&o.pageNumberArray.length>6||o.pageNumberArray[o.currentPage]<t&&1!==t&&o.pageNumberArray.length>6&&o.pageNumberArray.length!==t?"hide-page-no":"show-page-no"),e.xp6(2),e.hij(" ",t," "),e.xp6(1),e.Q6J("ngIf",0===n&&o.pageNumberArray.length>6&&o.currentPage>2),e.xp6(1),e.Q6J("ngIf",n===o.pageNumberArray.length-2&&o.pageNumberArray.length>6)}}const U=function(s){return{disabled:s}};class Z{constructor(i){this.RoleService=i,this.rolesList=[],this.showFilter=!1,this.searchDataValue="",this.lastIndex=0,this.pageSize=10,this.totalData=0,this.skip=0,this.limit=this.pageSize,this.pageIndex=0,this.serialNumberArray=[],this.currentPage=1,this.pageNumberArray=[],this.pageSelection=[],this.totalPages=0,this.role_generals=[]}ngOnInit(){this.user=this.RoleService.authService.user,this.getTableData()}getTableData(){this.rolesList=[],this.serialNumberArray=[],this.RoleService.listRoles().subscribe(i=>{console.log(i),this.totalData=i.roles.length,this.role_generals=i.roles,this.getTableDataGeneral()})}isPermision(i){return!(!this.user.roles.includes("Super-Admin")&&!this.user.permissions.includes(i))}getTableDataGeneral(){this.rolesList=[],this.serialNumberArray=[],this.role_generals.map((i,t)=>{const n=t+1;t>=this.skip&&n<=this.limit&&(this.rolesList.push(i),this.serialNumberArray.push(n))}),this.dataSource=new E.by(this.rolesList),this.calculateTotalPages(this.totalData,this.pageSize)}selectRole(i){this.role_selected=i}deleteRol(){this.RoleService.deleteRoles(this.role_selected.id).subscribe(i=>{console.log(i);let t=this.rolesList.findIndex(n=>n.id==this.role_selected.id);-1!=t&&(this.rolesList.splice(t,1),$("#delete_patient").hide(),$("#delete_patient").removeClass("show"),$(".modal-backdrop").remove(),$("body").removeClass(),$("body").removeAttr("style"),this.role_selected=null)})}searchData(i){this.dataSource.filter=i.trim().toLowerCase(),this.rolesList=this.dataSource.filteredData}sortData(i){const t=this.rolesList.slice();this.rolesList=i.active&&""!==i.direction?t.sort((n,o)=>(n[i.active]<o[i.active]?-1:1)*("asc"===i.direction?1:-1)):t}getMoreData(i){"next"==i?(this.currentPage++,this.pageIndex=this.currentPage-1,this.limit+=this.pageSize,this.skip=this.pageSize*this.pageIndex,this.getTableDataGeneral()):"previous"==i&&(this.currentPage--,this.pageIndex=this.currentPage-1,this.limit-=this.pageSize,this.skip=this.pageSize*this.pageIndex,this.getTableDataGeneral())}moveToPage(i){this.currentPage=i,this.skip=this.pageSelection[i-1].skip,this.limit=this.pageSelection[i-1].limit,i>this.currentPage?this.pageIndex=i-1:i<this.currentPage&&(this.pageIndex=i+1),this.getTableDataGeneral()}PageSize(){this.pageSelection=[],this.limit=this.pageSize,this.skip=0,this.currentPage=1,this.searchDataValue="",this.getTableDataGeneral()}calculateTotalPages(i,t){this.pageNumberArray=[],this.totalPages=i/t,this.totalPages%1!=0&&(this.totalPages=Math.trunc(this.totalPages+1));for(var n=1;n<=this.totalPages;n++){const o=t*n,a=o-t;this.pageNumberArray.push(n),this.pageSelection.push({skip:a,limit:o})}}}function Q(s,i){1&s&&(e.TgZ(0,"div",15)(1,"div",26)(2,"div",27)(3,"strong"),e._uU(4,"Error!"),e.qZA(),e._uU(5," ES NECESARIO LLENAR UN NOMBRE Y SELECCIONAR UN PERMISO. "),e.TgZ(6,"button",28),e._UZ(7,"span",29),e.qZA()()()())}function Y(s,i){1&s&&(e.TgZ(0,"div",15)(1,"div",26)(2,"div",30)(3,"strong"),e._uU(4,"Exito!"),e.qZA(),e._uU(5," EL ROL SE EDITO CORRECTAMENTE. "),e.TgZ(6,"button",28),e._UZ(7,"span",29),e.qZA()()()())}function B(s,i){if(1&s&&(e.TgZ(0,"div",15)(1,"div",26)(2,"div",31)(3,"strong"),e._uU(4,"!"),e.qZA(),e._uU(5),e.TgZ(6,"button",28),e._UZ(7,"span",29),e.qZA()()()()),2&s){const t=e.oxw();e.xp6(5),e.hij(" ",t.text_validation,". ")}}function j(s,i){if(1&s){const t=e.EpF();e.ynx(0),e.TgZ(1,"div",34)(2,"label")(3,"input",35),e.NdJ("click",function(){const a=e.CHM(t).$implicit,m=e.oxw(3);return e.KtG(m.addPermission(a))}),e.qZA(),e._uU(4),e.qZA()(),e.BQk()}if(2&s){const t=i.$implicit,n=e.oxw(3);e.xp6(3),e.Q6J("checked",n.permissions.includes(t.permision)),e.xp6(1),e.hij(" ",t.menuValue," ")}}function z(s,i){if(1&s&&(e.TgZ(0,"div",33),e.YNc(1,j,5,2,"ng-container",25),e.qZA()),2&s){const t=e.oxw().$implicit;e.xp6(1),e.Q6J("ngForOf",t.subMenus)}}function G(s,i){if(1&s){const t=e.EpF();e.TgZ(0,"div",33)(1,"div",34)(2,"label")(3,"input",35),e.NdJ("click",function(){e.CHM(t);const o=e.oxw().$implicit,a=e.oxw();return e.KtG(a.addPermission(o))}),e.qZA(),e._uU(4),e.qZA()()()}if(2&s){const t=e.oxw().$implicit,n=e.oxw();e.xp6(3),e.Q6J("checked",n.permissions.includes(t.permision)),e.xp6(1),e.hij(" ",t.menuValue," ")}}function V(s,i){if(1&s&&(e.ynx(0),e.TgZ(1,"tr")(2,"td"),e._uU(3),e.qZA(),e.TgZ(4,"td"),e.YNc(5,z,2,1,"div",32),e.YNc(6,G,5,2,"div",32),e.qZA()(),e.BQk()),2&s){const t=i.$implicit;e.xp6(3),e.Oqu(t.menuValue),e.xp6(2),e.Q6J("ngIf",t.subMenus&&t.subMenus.length>0),e.xp6(1),e.Q6J("ngIf",t.subMenus&&0==t.subMenus.length)}}Z.\u0275fac=function(i){return new(i||Z)(e.Y36(d))},Z.\u0275cmp=e.Xpm({type:Z,selectors:[["app-list-role-user"]],decls:69,vars:12,consts:[[1,"page-wrapper"],[1,"content"],[1,"page-header"],[1,"row"],[1,"col-sm-12"],[1,"breadcrumb"],[1,"breadcrumb-item"],["href","#"],[1,"feather","icon-chevron-right"],[1,"breadcrumb-item","active"],[1,"card","card-table","show-entire"],[1,"card-body"],[1,"page-table-header","mb-2"],[1,"row","align-items-center"],[1,"col"],[1,"doctor-table-blk"],[1,"doctor-search-blk"],[1,"top-nav-search","table-search-blk"],["placeholder","Search here",1,"form-control",3,"ngModel","ngModelChange"],[1,"btn"],["src","assets/img/icons/search-normal.svg","alt",""],[1,"add-group"],["routerLink","/roles/register",1,"btn","btn-primary","add-pluss","ms-2"],["src","assets/img/icons/plus.svg","alt",""],["href","javascript:;",1,"btn","btn-primary","doctor-refresh","ms-2",3,"click"],["src","assets/img/icons/re-fresh.svg","alt",""],[1,"col-auto","text-end","float-end","ms-auto","download-grp"],["href","javascript:;",1,"me-2"],["src","assets/img/icons/pdf-icon-01.svg","alt",""],["src","assets/img/icons/pdf-icon-02.svg","alt",""],["src","assets/img/icons/pdf-icon-03.svg","alt",""],["href","javascript:;"],["src","assets/img/icons/pdf-icon-04.svg","alt",""],[1,"table-responsive"],["matSort","",1,"table","border-0","custom-table","comman-table","datatable","mb-0",3,"matSortChange"],["mat-sort-header","name"],["mat-sort-header","permisos"],["mat-sort-header","created_at"],[4,"ngFor","ngForOf"],[1,"table_footer"],[1,"col-sm-12","col-md-5"],[1,"dataTables_info"],[1,"col-sm-12","col-md-7"],[1,"pagination_section"],[1,"pagination"],[1,"page-item",3,"ngClass"],["href","javascript:void(0);","tabindex","-1",1,"page-link",3,"click"],["href","javascript:void(0);",1,"page-link",3,"click"],[1,"text-end"],["class","dropdown dropdown-action",4,"ngIf"],["role","dialog",1,"modal","fade","delete-modal"],[1,"modal-dialog","modal-dialog-centered"],[1,"modal-content"],[1,"modal-body","text-center"],["src","assets/img/sent.png","alt","","width","50","height","46"],[4,"ngIf"],[1,"m-t-20"],["href","javascript:void(0);","data-bs-dismiss","modal",1,"btn","btn-white","me-1"],["type","submit",1,"btn","btn-danger",3,"click"],[1,"dropdown","dropdown-action"],["href","javascript:void(0);","data-bs-toggle","dropdown","aria-expanded","false",1,"action-icon","dropdown-toggle"],[1,"fa","fa-ellipsis-v"],[1,"dropdown-menu","dropdown-menu-end"],["class","dropdown-item",3,"routerLink",4,"ngIf"],["class","dropdown-item","href","javascript:void(0);","data-bs-toggle","modal",3,"click",4,"ngIf"],[1,"dropdown-item",3,"routerLink"],[1,"fa-solid","fa-pen-to-square","m-r-5"],["href","javascript:void(0);","data-bs-toggle","modal",1,"dropdown-item",3,"click"],[1,"fa","fa-trash-alt","m-r-5"],["class","page-item",3,"hidden","click",4,"ngIf"],[1,"page-item",3,"hidden","click"],["href","javascript:void(0);",1,"page-link"]],template:function(i,t){1&i&&(e.TgZ(0,"div",0)(1,"div",1)(2,"div",2)(3,"div",3)(4,"div",4)(5,"ul",5)(6,"li",6)(7,"a",7),e._uU(8,"Roles y Permisos "),e.qZA()(),e.TgZ(9,"li",6),e._UZ(10,"i",8),e.qZA(),e.TgZ(11,"li",9),e._uU(12,"Role List"),e.qZA()()()()(),e.TgZ(13,"div",3)(14,"div",4)(15,"div",10)(16,"div",11)(17,"div",12)(18,"div",13)(19,"div",14)(20,"div",15)(21,"h3"),e._uU(22,"Role List"),e.qZA(),e.TgZ(23,"div",16)(24,"div",17)(25,"input",18),e.NdJ("ngModelChange",function(o){return t.searchDataValue=o})("ngModelChange",function(){return t.searchData(t.searchDataValue)}),e.qZA(),e.TgZ(26,"a",19),e._UZ(27,"img",20),e.qZA()(),e.TgZ(28,"div",21)(29,"a",22),e._UZ(30,"img",23),e.qZA(),e.TgZ(31,"a",24),e.NdJ("click",function(){return t.PageSize()}),e._UZ(32,"img",25),e.qZA()()()()(),e.TgZ(33,"div",26)(34,"a",27),e._UZ(35,"img",28),e.qZA(),e.TgZ(36,"a",27),e._UZ(37,"img",29),e.qZA(),e.TgZ(38,"a",27),e._UZ(39,"img",30),e.qZA(),e.TgZ(40,"a",31),e._UZ(41,"img",32),e.qZA()()()(),e.TgZ(42,"div",33)(43,"table",34),e.NdJ("matSortChange",function(o){return t.sortData(o)}),e.TgZ(44,"thead")(45,"tr")(46,"th",35),e._uU(47,"Nombre"),e.qZA(),e.TgZ(48,"th",36),e._uU(49,"Permisos"),e.qZA(),e.TgZ(50,"th",37),e._uU(51,"Fecha de registro"),e.qZA(),e._UZ(52,"th"),e.qZA()(),e.TgZ(53,"tbody"),e.YNc(54,P,20,6,"tr",38),e.qZA()(),e.TgZ(55,"div",39)(56,"div",40)(57,"div",41),e._uU(58),e.qZA()(),e.TgZ(59,"div",42)(60,"div",43)(61,"ul",44)(62,"li",45)(63,"a",46),e.NdJ("click",function(){return t.getMoreData("previous")}),e._uU(64,"Previous"),e.qZA()(),e.YNc(65,O,6,6,"ng-container",38),e.TgZ(66,"li",45)(67,"a",47),e.NdJ("click",function(){return t.getMoreData("next")}),e._uU(68,"Next "),e.qZA()()()()()()()()()()()()()),2&i&&(e.xp6(25),e.Q6J("ngModel",t.searchDataValue),e.xp6(29),e.Q6J("ngForOf",t.rolesList),e.xp6(4),e.lnq(" Showing ",t.serialNumberArray[0]," to ",t.serialNumberArray[t.serialNumberArray.length-1]," of ",t.totalData," entries "),e.xp6(4),e.Q6J("ngClass",e.VKq(8,U,1===t.currentPage)),e.xp6(3),e.Q6J("ngForOf",t.pageNumberArray),e.xp6(1),e.Q6J("ngClass",e.VKq(10,U,t.currentPage===t.pageNumberArray[t.pageNumberArray.length-1]||0===t.rolesList.length)))},dependencies:[c.mk,c.sg,c.O5,p.rH,r.Fj,r.JJ,r.On]});class b{constructor(i,t,n){this.DataService=i,this.RoleService=t,this.activedRoute=n,this.sideBar=[],this.name="",this.permissions=[],this.valid_form=!1,this.valid_form_success=!1,this.text_validation=null}ngOnInit(){this.sideBar=this.DataService.sideBar[0].menu,this.activedRoute.params.subscribe(i=>{this.role_id=i.id}),this.showRole()}showRole(){this.RoleService.showRoles(this.role_id).subscribe(i=>{console.log(i),this.name=i.name,this.permissions=i.permision_pluck})}addPermission(i){if(i.permision){let t=this.permissions.findIndex(n=>n==i.permision);-1!=t?this.permissions.splice(t,1):this.permissions.push(i.permision),console.log(this.permissions)}}save(){if(this.valid_form=!1,!this.name||0==this.permissions.length)return void(this.valid_form=!0);let i={name:this.name,permisions:this.permissions};this.valid_form_success=!1,this.text_validation=null,this.RoleService.editRoles(i,this.role_id).subscribe(t=>{console.log(t),403!=t.message?this.valid_form_success=!0:this.text_validation=t.message_text})}}b.\u0275fac=function(i){return new(i||b)(e.Y36(A.D),e.Y36(d),e.Y36(p.gz))},b.\u0275cmp=e.Xpm({type:b,selectors:[["app-edit-role-user"]],decls:46,vars:6,consts:[[1,"page-wrapper"],[1,"content"],[1,"page-header"],[1,"row"],[1,"col-sm-12"],[1,"breadcrumb"],[1,"breadcrumb-item"],["href","#"],[1,"feather","icon-chevron-right"],[1,"breadcrumb-item","active"],[1,"row","justify-content-center"],[1,"col-lg-8"],[1,"card-box"],[1,"card-title"],["action","#"],[1,"form-group","row"],[1,"col-form-label","col-md-2"],[1,"col-md-10"],["type","text","name","name",1,"form-control",3,"ngModel","ngModelChange"],[1,"col-md-12","text-end"],[1,"btn","btn-primary",3,"click"],["class","form-group row",4,"ngIf"],[1,"card-block"],[1,"table-responsive"],[1,"table","table-bordered","mb-0"],[4,"ngFor","ngForOf"],[1,"col-md-8"],["role","alert",1,"alert","alert-danger","alert-dismissible","fade","show"],["type","button","data-bs-dismiss","alert","aria-label","Close",1,"btn-close"],["aria-hidden","true"],["role","alert",1,"alert","alert-success","alert-dismissible","fade","show"],["role","alert",1,"alert","alert-warning","alert-dismissible","fade","show"],["class","",4,"ngIf"],[1,""],[1,"checkbox"],["type","checkbox","name","checkbox",3,"checked","click"]],template:function(i,t){1&i&&(e.TgZ(0,"div",0)(1,"div",1)(2,"div",2)(3,"div",3)(4,"div",4)(5,"ul",5)(6,"li",6)(7,"a",7),e._uU(8,"Roles y Permisos "),e.qZA()(),e.TgZ(9,"li",6),e._UZ(10,"i",8),e.qZA(),e.TgZ(11,"li",9),e._uU(12,"Edici\xf3n"),e.qZA()()()()(),e.TgZ(13,"div",10)(14,"div",11)(15,"div",12)(16,"h4",13),e._uU(17),e.qZA(),e.TgZ(18,"form",14)(19,"div",15)(20,"label",16),e._uU(21,"Nombre"),e.qZA(),e.TgZ(22,"div",17)(23,"input",18),e.NdJ("ngModelChange",function(o){return t.name=o}),e.qZA()()(),e.TgZ(24,"div",15)(25,"div",19)(26,"button",20),e.NdJ("click",function(){return t.save()}),e._uU(27,"EDITAR"),e.qZA()()(),e.YNc(28,Q,8,0,"div",21),e.YNc(29,Y,8,0,"div",21),e.YNc(30,B,8,1,"div",21),e.qZA()()(),e.TgZ(31,"div",11)(32,"div",12)(33,"h4",13),e._uU(34,"Asignaci\xf3n de Permisos"),e.qZA(),e.TgZ(35,"div",22)(36,"div",23)(37,"table",24)(38,"thead")(39,"tr")(40,"th"),e._uU(41,"Secci\xf3n"),e.qZA(),e.TgZ(42,"th"),e._uU(43,"Permisos"),e.qZA()()(),e.TgZ(44,"tbody"),e.YNc(45,V,7,3,"ng-container",25),e.qZA()()()()()()()()()),2&i&&(e.xp6(17),e.hij("Editar Rol : ",t.name,""),e.xp6(6),e.Q6J("ngModel",t.name),e.xp6(5),e.Q6J("ngIf",t.valid_form),e.xp6(1),e.Q6J("ngIf",t.valid_form_success),e.xp6(1),e.Q6J("ngIf",t.text_validation),e.xp6(15),e.Q6J("ngForOf",t.sideBar))},dependencies:[c.sg,c.O5,r._Y,r.Fj,r.JJ,r.JL,r.On,r.F]});const K=[{path:"",component:h,children:[{path:"register",component:f},{path:"list",component:Z},{path:"list/edit/:id",component:b}]}];class u{}u.\u0275fac=function(i){return new(i||u)},u.\u0275mod=e.oAB({type:u}),u.\u0275inj=e.cJS({imports:[p.Bz.forChild(K),p.Bz]});class g{}g.\u0275fac=function(i){return new(i||g)},g.\u0275mod=e.oAB({type:g}),g.\u0275inj=e.cJS({imports:[c.ez,u,r.u5,r.UX,_.JF,p.Bz]})}}]);
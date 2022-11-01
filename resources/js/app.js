import Alerts from "./components/Header/Alerts";
import PackageForm from "./components/packages/PackageForm";
import PackageTabs from "./components/packages/PackageTabs";
import PackageItem from "./components/packages/PackageItem";
import PackageFilters from "./components/packages/PackageFilters";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {library} from "@fortawesome/fontawesome-svg-core";
import {fas} from "@fortawesome/free-solid-svg-icons";
import Notifications from '@kyvg/vue3-notification'
import { createApp } from "vue";
import Alpine from 'alpinejs';
import DateHelper from "./mixins/DateHelper";
import PackageShow from "./components/packages/PackageShow";
import PackagesList from "./components/packages/PackagesList";
import PackagesListToGroupForm from "./components/packages/PackagesListToGroupForm";
import FlowList from "./components/FlowList";
import JsonTree from 'vue-json-tree'
import VuePdfEmbed from 'vue-pdf-embed'


require('./bootstrap');

window.Alpine = Alpine;



Alpine.start();


const app = createApp({});


// import moment from "moment";

library.add(fas);
app.component('font-awesome-icon', FontAwesomeIcon);
app.component('json-tree', JsonTree);
app.component('vue-pdf-embed', VuePdfEmbed);


app.use(Notifications);

app.component('date-helper', DateHelper);

app.component('component-flow-list', FlowList);
app.component('packages-list', PackagesList);
app.component('package-show', PackageShow);
app.component('package-form', PackageForm);
app.component('package-tabs', PackageTabs);
app.component('package-filters', PackageFilters);
app.component('packages-list-to-group-form', PackagesListToGroupForm);

app.component('package-item', PackageItem);
app.component('component-alerts', Alerts);

app.mount('#app');

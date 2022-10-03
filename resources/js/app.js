import Alerts from "./Components/Header/Alerts";
import ParcelForm from "./Components/ParcelForm";
import ParcelTabs from "./Components/ParcelTabs";
import ParcelItem from "./Components/ParcelItem";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {library} from "@fortawesome/fontawesome-svg-core";
import {fas} from "@fortawesome/free-solid-svg-icons";
import Notifications from '@kyvg/vue3-notification'
import { createApp } from "vue";
import Alpine from 'alpinejs';
import DateHelper from "./Mixins/DateHelper";
import ParcelShow from "./Components/ParcelShow";
import ParcelsList from "./Components/ParcelsList";
import FlowList from "./Components/FlowList";


require('./bootstrap');

window.Alpine = Alpine;



Alpine.start();


const app = createApp({});


// import moment from "moment";

library.add(fas);
app.component('font-awesome-icon', FontAwesomeIcon);

app.use(Notifications);

app.component('date-helper', DateHelper);

app.component('component-flow-list', FlowList);
app.component('component-parcels-list', ParcelsList);
app.component('component-parcel-show', ParcelShow);
app.component('component-parcel-form', ParcelForm);
app.component('parcel-tabs', ParcelTabs);

app.component('parcel-item', ParcelItem);
app.component('component-alerts', Alerts);

app.mount('#app');

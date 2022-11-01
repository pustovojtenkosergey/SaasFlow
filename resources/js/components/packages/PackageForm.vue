<template>
    <div class="row">
        <div :class="showPreJson ? 'col-8' : 'col-11'">
            <form method="post">

                <div class="row">
                    <div class="col mx-2">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="global_rand" v-model="globalRand">
                            <label class="custom-control-label" for="global_rand">Random</label>
                        </div>
                    </div>
                    <div class="col my-3">

                        <button type="button" class="btn btn-success float-right" @click="submitForm">Submit</button>
                    </div>
                </div>

                <div>
                    <package-tabs :tabList="tabList">
                        <template v-slot:tabPanel-0>
                            <div class="row m-1 p-3">
                                <div class="col-md-3">
                                    <select class="custom-select"
                                            id="service_id"
                                            v-model="formData.service.service_id"
                                            :disabled="globalRand"
                                    >
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="service in services" :value="service">{{ service }}</option>
                                    </select>
                                    <label for="service_id">service</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="shipping_cost_amount"
                                               v-model="formData.service.shipping_cost.amount"
                                               :disabled="globalRand"
                                        >
                                        <label for="shipping_cost_amount">Shipping cost amount</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-row">
                                        <select class="custom-select"
                                                id="shipping_cost_currency"
                                                v-model="formData.service.shipping_cost.currency"
                                                :disabled="globalRand"
                                        >
                                            <option v-for="currency in currencies" :value="currency">{{ currency }}</option>
                                        </select>
                                        <label for="shipping_cost_currency">Currency</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-row">
                                        <input type="datetime-local"
                                               class="form-control form-control-sm"
                                               id="collection_date"
                                               v-model="formData.service.collection_date"
                                        >
                                        <label for="collection_date">Collection date</label>
                                    </div>
                                    <div class="form-row">
                                        <input type="datetime-local"
                                               class="form-control form-control-sm"
                                               id="delivery_date"
                                               v-model="formData.service.delivery_date"
                                        >
                                        <label for="delivery_date">Delivery date</label>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-slot:tabPanel-1>
                            <div class="row m-1 p-3">
                                <div class="col-md-3">
                                    <select class="custom-select"
                                            id="category"
                                            v-model="formData.details.category"
                                            :disabled="globalRand"
                                    >
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="category in categories" :value="category">{{ category }}</option>
                                    </select>
                                    <label for="category">Category</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="custom-select"
                                            id="incoterm"
                                            v-model="formData.details.incoterm"
                                            :disabled="globalRand"
                                    >
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="incoterm in incoterms" :value="incoterm">{{ incoterm }}</option>
                                    </select>
                                    <label for="incoterm">Incoterm</label>
                                </div>
                            </div>
                            <div class="row m-1 p-3">
                                <div class="col-md-3 m-2 p-2 border">
                                    <p>Weight</p>
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="details_weight_value"
                                               v-model="formData.details.weight.weight_value"
                                               :disabled="globalRand"
                                        >
                                        <label for="details_weight_value">Weight</label>
                                        <select class="custom-select"
                                                id="details_weight_unit"
                                                v-model="formData.details.weight.weight_unit"
                                                :disabled="globalRand"
                                        >
                                            <option v-for="weightUnit in weightUnits" :value="weightUnit">{{ weightUnit }}</option>
                                        </select>
                                        <label for="details_weight_unit">Unit</label>
                                    </div>
                                </div>
                                <div class="col-md-3 m-2 p-2 border">
                                    <p>Dimensions</p>
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="details_dimensions_length"
                                               v-model="formData.details.dimensions.length"
                                               :disabled="globalRand"
                                        >
                                        <label for="details_dimensions_length">Length</label>
                                        <input type="text"
                                               class="form-control"
                                               id="details_dimensions_width"
                                               v-model="formData.details.dimensions.width"
                                               :disabled="globalRand"
                                        >
                                        <label for="details_dimensions_length">Width</label>
                                        <input type="text"
                                               class="form-control"
                                               id="details_dimensions_height"
                                               v-model="formData.details.dimensions.height"
                                               :disabled="globalRand"
                                        >
                                        <label for="details_dimensions_height">Height</label>
                                        <select class="custom-select"
                                                id="details_dimensions_unit"
                                                v-model="formData.details.dimensions.dimensions_unit"
                                                :disabled="globalRand"
                                        >
                                            <option v-for="dimensionsUnit in dimensionsUnits" :value="dimensionsUnit">{{ dimensionsUnit }}</option>
                                        </select>
                                        <label for="details_dimensions_unit">Dimensions unit</label>
                                    </div>
                                </div>

                                <div class="col-md-2 m-2 p-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="details_value_amount"
                                               v-model="formData.details.value.amount"
                                               :disabled="globalRand"
                                        >
                                        <label for="details_value_amount">Value</label>
                                        <select class="custom-select"
                                                id="details_value_currency"
                                                v-model="formData.details.value.currency"
                                                :disabled="globalRand"
                                        >
                                            <option v-for="currency in currencies" :value="currency">{{ currency }}</option>
                                        </select>
                                        <label for="details_value_currency">Currency</label>
                                    </div>
                                </div>
                                <div class="col-md-2 m-2 p-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="details_cod_amount"
                                               v-model="formData.details.cod.amount"
                                               :disabled="globalRand"
                                        >
                                        <label for="details_cod_amount">Cod</label>
                                        <select class="custom-select"
                                                id="details_cod_currency"
                                                v-model="formData.details.cod.currency"
                                                :disabled="globalRand"
                                        >
                                            <option v-for="currency in currencies" :value="currency">{{ currency }}</option>
                                        </select>
                                        <label for="details_cod_currency">Currency</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-1 p-3">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="formData.details.dangerous_goods"
                                               :disabled="globalRand"
                                               id="dangerous_goods"
                                        >
                                        <label class="form-check-label" for="dangerous_goods">
                                            Dangerous goods
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-slot:tabPanel-2>
                            <div class="row m-1 p-3">
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <input type="text" class="form-control"
                                               id="contact_name"
                                               v-model="formData.contact.name"
                                               :disabled="globalRand">
                                        <label for="contact_name">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <input type="text" class="form-control"
                                               id="contact_company_name"
                                               v-model="formData.contact.company_name"
                                               :disabled="globalRand">
                                        <label for="contact_company_name">Company</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <input type="text" class="form-control"
                                               id="contact_phone"
                                               v-model="formData.contact.phone"
                                               :disabled="globalRand">
                                        <label for="contact_phone">Phone</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <input type="email" class="form-control"
                                               id="contact_email"
                                               v-model="formData.contact.email"
                                               :disabled="globalRand">
                                        <label for="contact_email">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-1 p-3">
                                <div class="col-md-12">
                                    <h4>Address</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <textarea
                                               class="form-control"
                                               id="contact_address_line_1"
                                               v-model="formData.contact.address_line_1"
                                               :disabled="globalRand"
                                        >
                                        </textarea>
                                        <label for="contact_address_line_1">Address line 1</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <textarea
                                               class="form-control"
                                               id="contact_address_line_2"
                                               v-model="formData.contact.address_line_2"
                                               :disabled="globalRand"
                                        >
                                        </textarea>
                                        <label for="contact_address_line_2">Address line 2</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <textarea class="form-control"
                                                  id="contact_address_line_3"
                                                  v-model="formData.contact.address_line_3"
                                                  :disabled="globalRand">
                                        </textarea>
                                        <label for="contact_address_line_3">Address line 3</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <input type="text" class="form-control"
                                                  id="contact_city"
                                                  v-model="formData.contact.city"
                                                  :disabled="globalRand">
                                        <label for="contact_city">City</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <input type="text" class="form-control"
                                               id="contact_state"
                                               v-model="formData.contact.state"
                                               :disabled="globalRand">
                                        <label for="contact_state">State</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <input type="text" class="form-control"
                                               id="contact_zip"
                                               v-model="formData.contact.zip"
                                               :disabled="globalRand">
                                        <label for="contact_zip">ZIP</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                    <select class="custom-select"
                                            id="category"
                                            v-model="formData.contact.country"
                                            :disabled="globalRand"
                                    >
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="(country, alpha2)  in countries" :value="alpha2">{{ country }}</option>
                                    </select>
                                    <label for="category">Country</label>
                                    </div>
                                </div>

                            </div>
                        </template>
                        <template v-slot:tabPanel-3>
                            <div class="row m-1 p-3">
                                <div class="col-md-1">
                                    <button type="button"
                                            class="btn btn-circle btn-danger"
                                            :disabled="formData.items.length <= 1"
                                            @click="removeItem(null)"><font-awesome-icon icon="fa-solid fa-trash" /></button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button"
                                            class="btn btn-circle btn-primary"
                                            @click="addItem">
                                        <font-awesome-icon icon="fa-solid fa-box" />
                                        <span class="ml-2">
                                            {{ formData.items.length }}
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <package-item v-for="(item, index) in formData.items"
                                             :is-first="index === 0"
                                             :item="item"
                                             :global-rand="globalRand"
                                             :get-item="getItem"
                                             :make-id="makeId"
                                             :remove="removeItem"
                                             :currencies="currencies"
                                             :countries="countries"
                                ></package-item>
                                <div class="col-md-5 border p-2 m-1 item-block">
                                    <button type="button"
                                            class="btn btn-lg btn-outline-primary w-100 h-100"
                                            @click="addItem">
                                         <font-awesome-icon icon="fa-solid fa-box" />
                                    </button>
                                </div>
                            </div>
                        </template>
                    </package-tabs>
                </div>

            </form>
        </div>
        <div :class="showPreJson ? 'col-4 border p-3' : 'col-1'">
            <div class="float-right" @click="togglePreJson">
                <font-awesome-icon icon="fa-solid fa-eye-slash" v-if="showPreJson"/>
                <button class="btn border"  v-else>PreView</button>
            </div>
            <json-tree v-if="showPreJson" :raw="jsonStr"></json-tree>
        </div>
    </div>
    <notifications position="bottom right" />
</template>

<script>

import moment from "moment/moment";
import PackageTabs from "./PackageTabs";
import PackageItem from "./PackageItem";
import PackagePreviewData from "../../mixins/PackagePreviewMixin";

const defaultItem = {
    index: 0,
    quantity: 1,
    description: "Test package",
    value_amount: null,
    sku: "",
    hs_code: "",
    country_of_origin: null,
    extra: {
        value_currency: "USD",
    }
};

export default {
    components: {
        PackageTabs, PackageItem
    },
    props: ['from', 'to', 'services', 'labelFormats', 'currencies', 'countries', 'storeRoute', 'randomContactRoute'],
    mixins: [PackagePreviewData],
    data() {
        return {
            tabList: ["Services", "Details", "Contact", "Items"],
            showPreJson: true,
            jsonStr: '{}',
            categories: ["gifts", "documents", "commercial goods", "commercial sample", "returned goods", "other", "clothing", "intercompany transfer", "repair", "personal_items"],
            incoterms: ["DDP", "DDU"],
            weightUnits: ["kg", "g", "lb", 'test'],
            dimensionsUnits: ["cm", "m"],
            itemIndex: 0,
            savedFormData: {},
            globalRand: false,
            formData: {
                service: {
                    service_id: null,
                    shipping_cost: {
                        amount: null,
                        currency: null,
                    },
                    collection_date: null,
                    delivery_date: null
                },
                details: {
                    category: "gifts",
                    dangerous_goods: false,
                    incoterm: "DDP",
                    value: {
                        amount: 1,
                        currency: "USD"
                    },
                    cod: {
                        amount: 1,
                        currency: "USD"
                    },
                    weight: {
                        weight_value: 1,
                        weight_unit: "kg"
                    },
                    dimensions: {
                        length: 1,
                        width: 1,
                        height: 1,
                        dimensions_unit: "cm"
                    }
                },
                contact: {
                    name: null,
                    company_name: null,
                    address_line_1: null,
                    address_line_2: null,
                    address_line_3: null,
                    city: null,
                    state: null,
                    zip: null,
                    country: null,
                    phone: null,
                    email: null,
                },
                items: [{...defaultItem}],
            }
        }
    },
    watch: {
        globalRand(value) {
            if (value) {
                this.savedFormData = {...this.formData};
            } else {
                this.formData = {...this.savedFormData};
                this.savedFormData = {};
            }

            this.serviceIdRand(value);
            this.shippingCostRand(value);
            this.categoryRand(value);
            this.dangerousGoodsRand(value);
            this.incotermRand(value);
            this.detailsValueRand(value);
            this.detailsCodRand(value);
            this.detailsWeightRand(value);
            this.detailsDimensionsRand(value);
            this.contactRand(value);
        },
        formData: {
            handler(data){
                this.showPreparedData(data);
            },
            deep: true
        }
    },
    mounted() {
        this.formData.service.service_id = this.services[0];

        if (this.to) {
            this.formData.contact.country = this.to;
        }

        this.formData.service.collection_date = moment().toISOString().slice(0,16);
        this.formData.service.delivery_date = moment().toISOString().slice(0,16);

        this.formData.details.category = this.categories[0];

        this.formData.items[0].extra.country_of_origin = 'GB';
    },
    methods: {
        serviceIdRand(value) {
            if (!value) return;
            const random = Math.floor(Math.random() * this.services.length);
            this.formData.service.service_id = this.services[random];
        },
        shippingCostRand(value) {
            if (!value) return;
            this.formData.service.shipping_cost.amount =  Math.floor(Math.random() * 1000);
            const randomCurrency = Math.floor(Math.random() * this.currencies.length);
            this.formData.service.shipping_cost.currency = this.currencies[randomCurrency];
        },
        categoryRand(value) {
            if (!value) return;
            const random = Math.floor(Math.random() * this.categories.length);
            this.formData.details.category = this.categories[random];
        },
        dangerousGoodsRand(value) {
            if (!value) return;
            this.formData.details.dangerous_goods = Math.random() < 0.5;
        },
        incotermRand(value) {
            if (!value) return;
            const random = Math.floor(Math.random() * this.incoterms.length);
            this.formData.details.incoterm = this.incoterms[random];
        },
        detailsValueRand(value) {
            if (!value) return;
            this.formData.details.value.amount =  Math.floor(Math.random() * 1000);
            const randomCurrency = Math.floor(Math.random() * this.currencies.length);
            this.formData.details.value.currency = this.currencies[randomCurrency];
        },
        detailsCodRand(value) {
            if (!value) return;
            this.formData.details.cod.amount =  Math.floor(Math.random() * 1000);
            const randomCurrency = Math.floor(Math.random() * this.currencies.length);
            this.formData.details.cod.currency = this.currencies[randomCurrency];
        },
        detailsWeightRand(value) {
            if (!value) return;
            this.formData.details.weight.weight_value =  Math.floor(Math.random() * 10) + 1;
            const randomUnit = Math.floor(Math.random() * this.weightUnits.length);
            this.formData.details.weight.weight_unit = this.weightUnits[randomUnit];
        },
        detailsDimensionsRand(value) {
            if (!value) return;
            this.formData.details.dimensions.length =  Math.floor(Math.random() * 10) + 1;
            this.formData.details.dimensions.width =  Math.floor(Math.random() * 10) + 1;
            this.formData.details.dimensions.height =  Math.floor(Math.random() * 10) + 1;
            const randomUnit = Math.floor(Math.random() * this.dimensionsUnits.length);
            this.formData.details.dimensions.dimensions_unit = this.dimensionsUnits[randomUnit];
        },
        async contactRand(value) {
            if (!value) return;
            await axios.get(this.randomContactRoute)
                .then(response => {
                    if (response.data.id === undefined)
                        return;

                    const contactKeys = Object.keys(this.formData.contact);

                    contactKeys.forEach(key => {
                        this.formData.contact[key] = response.data[key] || '';
                    })
                }).catch(() => {
                    // TODO set all fields

                    const countries = Object.keys(this.countries);
                    const randomCountry = Math.floor(Math.random() * countries.length);
                    this.formData.contact.country = countries[randomCountry];
                });
        },
        submitForm() {
            axios.post(this.storeRoute, this.formData)
                .then(response => {
                    this.$notify({
                        title: "Package in work",
                        text: "Reference: " + response.data.reference,
                        type: 'warning'
                    });
                })
                .catch(response => {
                    this.$notify({
                        title: response.response.data.message || "Package error",
                        text: JSON.stringify(response.response.data.errors, undefined, 2),
                        type: 'error'
                    });
                });
        },
        showPreparedData(data) {
            if (data === null) {
                return;
            }

            this.jsonStr = JSON.stringify(this.prepareViewData(data), undefined, 2);
        },
        makeId(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        },
        addItem() {
            let item = {...defaultItem};
            item.index = ++this.itemIndex;
            item.description += ' ' + (item.index + 1);
            this.formData.items.push(item);
        },
        removeItem(itemIndex = null) {
            // TODO not works by index
            if (itemIndex === null) {
                this.formData.items.pop();
            } else {
                this.formData.items = this.formData.items.filter(item => item.index !== itemIndex);
            }
        },
        getItem(item, itemIndex) {
            const index = this.formData.items.findIndex(item => item.index === itemIndex);
            if (index !== -1) {
                this.formData.items[index] = item;
            }
        },
        togglePreJson() {
            this.showPreJson = !this.showPreJson;
        }
    }
}
</script>

<style>
.item-block {
    min-height: 550px;
}
</style>

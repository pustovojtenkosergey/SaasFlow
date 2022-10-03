<template>
    <div class="row">

        <div :class="showPreJson ? 'col-8' : 'col-11'">
            <form action="/parcel" method="post">

                <div class="row">
                    <div class="col mx-2">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="global_rand" v-model="globalRand">
                            <label class="custom-control-label" for="global_rand">Toggle global rand</label>
                        </div>
                    </div>
                    <div class="col my-3">

                        <button type="button" class="btn btn-success float-right" @click="submitForm">Submit</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-1 border my-2 mx-3 p-3" :class="formData.is_test ? 'bg-gradient-primary' : ''"
                         @click="formData.is_test = !formData.is_test">
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="is_test"
                                   v-model="formData.is_test"
                            >
                            <p>
                                Test mode
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 border m-2 p-3">
                        <select class="custom-select"
                                id="shipper_id"
                                v-model="formData.shipper_id"
                                :disabled="randScope.shipper_id_rand"
                        >
                            <option selected disabled value="">Choose...</option>
                            <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                        </select>
                        <label for="shipper_id">shipper</label>
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   v-model="randScope.shipper_id_rand"
                                   id="shipper_id_rand"
                            >
                            <label class="form-check-label" for="shipper_id_rand">
                                rand
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <parcel-tabs :tabList="tabList">
                        <template v-slot:tabPanel-0>
                            <div class="row m-1 p-3">
                                <div class="col-md-12">
                                    <h4>Service</h4>
                                </div>
                                <div class="col-md-2">
                                    <select class="custom-select"
                                            id="service_id"
                                            v-model="formData.service.service_id"
                                            :disabled="randScope.service_id_rand"
                                    >
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="service in services" :value="service">{{ service }}</option>
                                    </select>
                                    <label for="service_id">service</label>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.service_id_rand"
                                               id="service_id_rand"
                                        >
                                        <label class="form-check-label" for="service_id_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="pudo_id"
                                               v-model="formData.service.pudo_id"
                                               :disabled="randScope.pudo_id_rand"
                                        >
                                        <label for="pudo_id">Pudo id</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.pudo_id_rand"
                                               id="pudo_id_rand"
                                        >
                                        <label class="form-check-label" for="pudo_id_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="custom-select"
                                            id="label_format"
                                            v-model="formData.service.label_format"
                                            :disabled="randScope.label_format_rand"
                                    >
                                        <option v-for="label_format in labelFormats" :value="label_format">{{ label_format }}</option>
                                    </select>
                                    <label for="label_format">Label format</label>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.label_format_rand"
                                               id="label_format_rand"
                                        >
                                        <label class="form-check-label" for="label_format_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="custom-select"
                                            id="label_type"
                                            v-model="formData.service.label_type"
                                            :disabled="randScope.label_type_rand"
                                    >
                                        <option v-for="label_type in labelTypes" :value="label_type">{{ label_type }}</option>
                                    </select>
                                    <label for="label_type">Label type</label>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.label_type_rand"
                                               id="label_type_rand"
                                        >
                                        <label class="form-check-label" for="label_type_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="shipping_cost_amount"
                                               v-model="formData.service.shipping_cost.amount"
                                               :disabled="randScope.shipping_cost_rand"
                                        >
                                        <label for="shipping_cost_amount">Shipping cost amount</label>
                                        <select class="custom-select"
                                                id="shipping_cost_currency"
                                                v-model="formData.service.shipping_cost.currency"
                                                :disabled="randScope.shipping_cost_rand"
                                        >
                                            <option v-for="currency in currencies" :value="currency">{{ currency }}</option>
                                        </select>
                                        <label for="shipping_cost_currency">Currency</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.shipping_cost_rand"
                                               id="shipping_cost_rand"
                                        >
                                        <label class="form-check-label" for="shipping_cost_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
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
                                <div class="col-md-12">
                                    <h4>Package</h4>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="number_of_piece"
                                               v-model="formData.package.number_of_piece"
                                               :disabled="randScope.number_of_piece_rand"
                                        >
                                        <label for="number_of_piece">Number of piece</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.number_of_piece_rand"
                                               id="number_of_piece_rand"
                                        >
                                        <label class="form-check-label" for="number_of_piece_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="order_reference"
                                               v-model="formData.package.order_reference"
                                               :disabled="randScope.order_reference_rand"
                                        >
                                        <label for="order_reference">Order reference</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.order_reference_rand"
                                               id="order_reference_rand"
                                        >
                                        <label class="form-check-label" for="order_reference_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="customer_id_reference"
                                               v-model="formData.package.customer_id_reference"
                                               :disabled="randScope.customer_id_reference_rand"
                                        >
                                        <label for="customer_id_reference">Customer id reference</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.customer_id_reference_rand"
                                               id="customer_id_reference_rand"
                                        >
                                        <label class="form-check-label" for="customer_id_reference_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="custom-select"
                                            id="category"
                                            v-model="formData.package.category"
                                            :disabled="randScope.category_rand"
                                    >
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="category in categories" :value="category">{{ category }}</option>
                                    </select>
                                    <label for="category">Category</label>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.category_rand"
                                               id="category_rand"
                                        >
                                        <label class="form-check-label" for="category_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="formData.package.dangerous_goods"
                                               :disabled="randScope.dangerous_goods_rand"
                                               id="dangerous_goods"
                                        >
                                        <label class="form-check-label" for="dangerous_goods">
                                            Dangerous goods
                                        </label>
                                    </div>
                                    <div class="form-check mt-5">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.dangerous_goods_rand"
                                               id="dangerous_goods_rand"
                                        >
                                        <label class="form-check-label" for="dangerous_goods_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="custom-select"
                                            id="incoterm"
                                            v-model="formData.package.incoterm"
                                            :disabled="randScope.incoterm_rand"
                                    >
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="incoterm in incoterms" :value="incoterm">{{ incoterm }}</option>
                                    </select>
                                    <label for="incoterm">Incoterm</label>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.incoterm_rand"
                                               id="incoterm_rand"
                                        >
                                        <label class="form-check-label" for="incoterm_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="package_value_amount"
                                               v-model="formData.package.value.amount"
                                               :disabled="randScope.package_value_rand"
                                        >
                                        <label for="package_value_amount">Value</label>
                                        <select class="custom-select"
                                                id="package_value_currency"
                                                v-model="formData.package.value.currency"
                                                :disabled="randScope.package_value_rand"
                                        >
                                            <option v-for="currency in currencies" :value="currency">{{ currency }}</option>
                                        </select>
                                        <label for="package_value_currency">Currency</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.package_value_rand"
                                               id="package_value_rand"
                                        >
                                        <label class="form-check-label" for="package_value_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="package_cod_amount"
                                               v-model="formData.package.cod.amount"
                                               :disabled="randScope.package_cod_rand"
                                        >
                                        <label for="package_cod_amount">Cod</label>
                                        <select class="custom-select"
                                                id="package_cod_currency"
                                                v-model="formData.package.cod.currency"
                                                :disabled="randScope.package_cod_rand"
                                        >
                                            <option v-for="currency in currencies" :value="currency">{{ currency }}</option>
                                        </select>
                                        <label for="package_cod_currency">Currency</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.package_cod_rand"
                                               id="package_cod_rand"
                                        >
                                        <label class="form-check-label" for="package_cod_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="package_weight_value"
                                               v-model="formData.package.weight.weight_value"
                                               :disabled="randScope.package_weight_rand"
                                        >
                                        <label for="package_weight_value">Weight</label>
                                        <select class="custom-select"
                                                id="package_weight_unit"
                                                v-model="formData.package.weight.weight_unit"
                                                :disabled="randScope.package_weight_rand"
                                        >
                                            <option v-for="weightUnit in weightUnits" :value="weightUnit">{{ weightUnit }}</option>
                                        </select>
                                        <label for="package_weight_unit">Unit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.package_weight_rand"
                                               id="package_weight_rand"
                                        >
                                        <label class="form-check-label" for="package_weight_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="form-row">
                                        <input type="text"
                                               class="form-control"
                                               id="package_dimensions_length"
                                               v-model="formData.package.dimensions.length"
                                               :disabled="randScope.package_dimensions_rand"
                                        >
                                        <label for="package_dimensions_length">Length</label>
                                        <input type="text"
                                               class="form-control"
                                               id="package_dimensions_width"
                                               v-model="formData.package.dimensions.width"
                                               :disabled="randScope.package_dimensions_rand"
                                        >
                                        <label for="package_dimensions_length">Width</label>
                                        <input type="text"
                                               class="form-control"
                                               id="package_dimensions_height"
                                               v-model="formData.package.dimensions.height"
                                               :disabled="randScope.package_dimensions_rand"
                                        >
                                        <label for="package_dimensions_height">Height</label>
                                        <select class="custom-select"
                                                id="package_dimensions_unit"
                                                v-model="formData.package.dimensions.dimensions_unit"
                                                :disabled="randScope.package_dimensions_rand"
                                        >
                                            <option v-for="dimensionsUnit in dimensionsUnits" :value="dimensionsUnit">{{ dimensionsUnit }}</option>
                                        </select>
                                        <label for="package_dimensions_unit">Dimensions unit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.package_dimensions_rand"
                                               id="package_dimensions_rand"
                                        >
                                        <label class="form-check-label" for="package_dimensions_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-slot:tabPanel-2>
                            <div class="row m-1 p-3">
                                <div class="col-md-12">
                                    <h4>Addresses</h4>
                                </div>
                                <div class="col-md-6">
                                    <select class="custom-select"
                                            id="category"
                                            v-model="formData.shipper_address.country"
                                            :disabled="randScope.shipper_address_country_rand"
                                    >
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="(country, alpha2)  in countries" :value="alpha2">{{ country }}</option>
                                    </select>
                                    <label for="category">Shipper country</label>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.shipper_address_country_rand"
                                               id="shipper_address_country_rand"
                                        >
                                        <label class="form-check-label" for="shipper_address_country_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="custom-select"
                                            id="category"
                                            v-model="formData.consignee_address.country"
                                            :disabled="randScope.consignee_address_country_rand"
                                    >
                                        <option selected disabled value="">Choose...</option>
                                        <option v-for="(country, alpha2)  in countries" :value="alpha2">{{ country }}</option>
                                    </select>
                                    <label for="category">Consignee country</label>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="randScope.consignee_address_country_rand"
                                               id="consignee_address_country_rand"
                                        >
                                        <label class="form-check-label" for="consignee_address_country_rand">
                                            rand
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-slot:tabPanel-3>
                            <div class="row m-1 p-3">
                                <div class="col-md-11">
                                    <h4>Items {{ formData.parcel_items.length }}</h4>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-circle btn-danger float-left" :disabled="formData.parcel_items.length <= 1" @click="removeItem">-</button>
                                    <button type="button" class="btn btn-circle btn-primary float-right" @click="addItem">+</button>
                                </div>
                            </div>
                            <div class="row">
                                <parcel-item v-for="(item, index) in formData.parcel_items"
                                             :index="index"
                                             :item="item"
                                             :global-rand="globalRand"
                                             :get-item="getItem"
                                             :make-id="makeId"
                                             :remove="removeItem"
                                             :currencies="currencies"
                                             :countries="countries"
                                ></parcel-item>
                                <div class="col-md-5 border p-2 m-1">
                                    <button type="button"
                                            class="btn btn-lg btn-outline-primary w-100 h-100"
                                            @click="addItem">
                                        ADD
                                    </button>
                                </div>
                            </div>
                        </template>
                    </parcel-tabs>
                </div>

            </form>
        </div>
        <div :class="showPreJson ? 'col-4 border p-3' : 'col-1'">
            <div class="float-right" @click="togglePreJson">
                <font-awesome-icon icon="fa-solid fa-eye-slash" v-if="showPreJson"/>
                <button class="btn border"  v-else>PreView</button>
            </div>
            <pre v-if="showPreJson">{{ jsonStr }}</pre>
        </div>
    </div>
    <notifications position="bottom right" />
</template>

<script>

import moment from "moment/moment";
import ParcelTabs from "./ParcelTabs";
import ParcelItem from "./ParcelItem";

const defaultItem = {
    quantity: 1,
    description: "Test parcel",
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
        ParcelTabs, ParcelItem
    },
    props: ['users', 'services', 'labelFormats', 'currencies', 'countries', 'storeRoute'],
    data() {
        return {
            tabList: ["Services", "Package", "Addresses", "Items"],
            showPreJson: true,
            jsonStr: null,
            labelTypes: ["system", "last_mile_carrier"],
            categories: ["gifts", "documents", "commercial_goods", "commercial_sample", "returned_goods", "other", "clothing", "intercompany_transfer", "repair", "personal_items"],
            incoterms: ["DDP", "DDU"],
            weightUnits: ["kg", "g", "lb"],
            dimensionsUnits: ["cm", "m"],
            savedFormData: {},
            globalRand: false,
            randScope: {
                shipper_id_rand: false,
                service_id_rand: false,
                pudo_id_rand: false,
                label_format_rand: false,
                label_type_rand: false,
                shipping_cost_rand: false,
                collection_date_rand: false,
                delivery_date_rand: false,
                number_of_piece_rand: false,
                order_reference_rand: false,
                customer_id_reference_rand: false,
                category_rand: false,
                dangerous_goods_rand: false,
                incoterm_rand: false,
                package_value_rand: false,
                package_cod_rand: false,
                package_weight_rand: false,
                package_dimensions_rand: false,
                shipper_address_country_rand: false,
                consignee_address_country_rand: false,
            },
            formData: {
                is_test: true,
                shipper_id: null,
                service: {
                    service_id: null,
                    pudo_id: '',
                    label_format: null,
                    label_type: null,
                    shipping_cost: {
                        amount: null,
                        currency: null,
                    },
                    collection_date: null,
                    delivery_date: null
                },
                package: {
                    number_of_piece: null,
                    order_reference: null,
                    customer_id_reference: null,
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
                shipper_address: {
                    country: "GB"
                },
                consignee_address: {
                    country: "GB"
                },
                parcel_items: [{...defaultItem}],
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
            Object.keys(this.randScope).forEach(key => {
                this.randScope[key] = value;
            });
        },
        'randScope.shipper_id_rand'(value) {
            if (!value) return;
            const random = Math.floor(Math.random() * this.users.length);
            this.formData.shipper_id = this.users[random].id;
        },
        'randScope.service_id_rand'(value) {
            if (!value) return;
            const random = Math.floor(Math.random() * this.services.length);
            this.formData.service.service_id = this.services[random];
        },
        'randScope.pudo_id_rand'(value) {
            if (!value) return;
            this.formData.service.pudo_id = Math.floor(Math.random() * 100);
        },
        'randScope.label_format_rand'(value) {
            if (!value) return;
            const random = Math.floor(Math.random() * this.labelFormats.length);
            this.formData.service.label_format = this.labelFormats[random];
        },
        'randScope.label_type_rand'(value) {
            if (!value) return;
            const random = Math.floor(Math.random() * this.labelTypes.length);
            this.formData.service.label_type = this.labelTypes[random];
        },
        'randScope.shipping_cost_rand'(value) {
            if (!value) return;
            this.formData.service.shipping_cost.amount =  Math.floor(Math.random() * 1000);
            const randomCurrency = Math.floor(Math.random() * this.currencies.length);
            this.formData.service.shipping_cost.currency = this.currencies[randomCurrency];
        },
        'randScope.number_of_piece_rand'(value) {
            if (!value) return;
            this.formData.package.number_of_piece = Math.floor(Math.random() * 10) + 1;
        },
        'randScope.order_reference_rand'(value) {
            if (!value) return;
            this.formData.package.order_reference = this.makeId(15);
        },
        'randScope.customer_id_reference_rand'(value) {
            if (!value) return;
            this.formData.package.customer_id_reference = this.makeId(10);
        },
        'randScope.category_rand'(value) {
            if (!value) return;
            const random = Math.floor(Math.random() * this.categories.length);
            this.formData.package.category = this.categories[random];
        },
        'randScope.dangerous_goods_rand'(value) {
            if (!value) return;
            this.formData.package.dangerous_goods = Math.random() < 0.5;
        },
        'randScope.incoterm_rand'(value) {
            if (!value) return;
            const random = Math.floor(Math.random() * this.incoterms.length);
            this.formData.package.incoterm = this.incoterms[random];
        },
        'randScope.package_value_rand'(value) {
            if (!value) return;
            this.formData.package.value.amount =  Math.floor(Math.random() * 1000);
            const randomCurrency = Math.floor(Math.random() * this.currencies.length);
            this.formData.package.value.currency = this.currencies[randomCurrency];
        },
        'randScope.package_cod_rand'(value) {
            if (!value) return;
            this.formData.package.cod.amount =  Math.floor(Math.random() * 1000);
            const randomCurrency = Math.floor(Math.random() * this.currencies.length);
            this.formData.package.cod.currency = this.currencies[randomCurrency];
        },
        'randScope.package_weight_rand'(value) {
            if (!value) return;
            this.formData.package.weight.weight_value =  Math.floor(Math.random() * 10) + 1;
            const randomUnit = Math.floor(Math.random() * this.weightUnits.length);
            this.formData.package.weight.weight_unit = this.weightUnits[randomUnit];
        },
        'randScope.package_dimensions_rand'(value) {
            if (!value) return;
            this.formData.package.dimensions.length =  Math.floor(Math.random() * 10) + 1;
            this.formData.package.dimensions.width =  Math.floor(Math.random() * 10) + 1;
            this.formData.package.dimensions.height =  Math.floor(Math.random() * 10) + 1;
            const randomUnit = Math.floor(Math.random() * this.dimensionsUnits.length);
            this.formData.package.dimensions.dimensions_unit = this.dimensionsUnits[randomUnit];
        },
        'randScope.shipper_address_country_rand'(value) {
            if (!value) return;
            const countries = Object.keys(this.countries);
            const randomCountry = Math.floor(Math.random() * countries.length);
            this.formData.shipper_address.country = countries[randomCountry];
        },
        'randScope.consignee_address_country_rand'(value) {
            if (!value) return;
            const countries = Object.keys(this.countries);
            const randomCountry = Math.floor(Math.random() * countries.length);
            this.formData.consignee_address.country = countries[randomCountry];
        },
        formData: {
            handler(data){
                this.showPreparedData(data);
            },
            deep: true
        }
    },
    mounted() {
        this.formData.shipper_id = this.users[0].id;
        this.formData.service.service_id = this.services[0];

        this.formData.service.label_format = this.labelFormats[0];
        this.formData.service.label_type = this.labelTypes[0];

        this.formData.service.collection_date = moment().toISOString().slice(0,16);
        this.formData.service.delivery_date = moment().toISOString().slice(0,16);

        this.formData.package.category = this.categories[0];

        this.formData.parcel_items[0].extra.country_of_origin = 'GB';
    },
    methods: {
        submitForm() {
            axios.post(this.storeRoute, this.formData)
                .then(response => {
                    this.$notify({
                        title: "Parcel in work",
                        text: "Reference: " + response.data.reference,
                        type: 'warning'
                    });
            }).catch(() => {
                this.$notify({
                    title: "Parcel error",
                    text: "Reference: " + response.data.reference,
                    type: 'error'
                });
            });
        },
        showPreparedData(data) {
            this.jsonStr = JSON.stringify(data, undefined, 2);
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
            this.formData.parcel_items.push({...defaultItem});
        },
        removeItem() {
            this.formData.parcel_items.pop();
        },
        getItem(item, index) {
            this.formData.parcel_items[index] = item;
        },
        togglePreJson() {
            this.showPreJson = !this.showPreJson;
        }
    }
}
</script>

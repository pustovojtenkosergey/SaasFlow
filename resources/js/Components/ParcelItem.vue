<template>
    <div class="col-md-5 border p-2 m-1">
        <button type="button"
                class="btn btn-sm btn-circle btn-outline-danger float-right"
                v-if="index > 0"
                @click="remove"
        >
            remove
        </button>
        <div class="form-row my-2">
            <input type="number"
                   class="form-control w-25 mr-3"
                   :id="index + '-quantity'"
                   min="1"
                   v-model="formItem.quantity"
                   :disabled="rand"
            >
            <label :for="index + '-quantity'">Quantity</label>
        </div>
        <div class="form-row my-2">
                    <textarea class="form-control"
                              :id="index + '-description'"
                              v-model="formItem.description"
                              :disabled="rand"
                              rows="2">
                    </textarea>
            <label :for="index + '-description'">Description</label>
        </div>
        <div class="form-row my-2">
            <input type="number"
                   class="form-control"
                   :id="index + '-item_value_amount'"
                   :disabled="rand"
                   v-model="formItem.value_amount"
            >
            <label :for="index + '-item_value_amount'">Value</label>
            <select class="custom-select"
                    :id="index + '-item_value_currency'"
                    v-model="formItem.extra.value_currency"
                    :disabled="index > 0 || rand"
            >
                <option v-for="currency in currencies" :value="currency">{{ currency }}</option>
            </select>
            <label :for="index + '-item_value_currency'">Currency</label>
        </div>
        <div class="form-row my-2">
            <select class="custom-select"
                    :id="index + '-country_of_origin'"
                    :disabled="rand"
                    v-model="formItem.country_of_origin"
            >
                <option selected disabled value="">Choose...</option>
                <option v-for="(country, alpha2)  in countries" :value="alpha2">{{ country }}</option>
            </select>
            <label :for="index + '-country_of_origin'">Country of origin</label>
        </div>
        <div class="form-row my-2">
            <input type="text"
                   class="form-control"
                   :id="index + '-sku'"
                   :disabled="rand"
                   v-model="formItem.sku"
            >
            <label :for="index + '-sku'">Sku</label>
        </div>
        <div class="form-row my-2">
            <input type="text"
                   class="form-control"
                   :id="index + '-hs_code'"
                   :disabled="rand"
                   v-model="formItem.hs_code"
            >
            <label :for="index + '-hs_code'">hs code</label>
        </div>
        <div class="form-check">
            <input class="form-check-input"
                   type="checkbox"
                   v-model="rand"
                   :id="index + '-rand'"
            >
            <label class="form-check-label" :for="index + '-rand'">
                rand
            </label>
        </div>
    </div>

</template>

<script>

export default {
    props: ['getItem', 'remove', 'index', 'item', 'currencies', 'countries', 'makeId', 'globalRand'],
    data() {
        return {
            rand: false,
            savedFormItem: {},
            formItem: {...this.item}
        }
    },
    watch: {
        globalRand() {
              this.rand = this.globalRand;
        },
        rand(value) {
            if (value) {
                this.savedFormItem = {...this.formItem};
            } else {
                this.formItem = {...this.savedFormItem};
                this.savedFormItem = {};
            }
            this.setRand();
        },
        formItem: {
            handler(data) {
                this.getItem(data, this.index);
            },
            deep: true
        }
    },
    mounted() {

    },
    methods: {
        setRand() {
            const randItem = {};
            randItem.quantity = Math.floor(Math.random() * 10) + 1;
            randItem.description = 'Test parcel';
            randItem.value_amount = Math.floor(Math.random() * 100) + 1;

            randItem.extra = {
                value_currency: this.formItem.extra.value_currency
            };
            const countries = Object.keys(this.countries);
            const randomCountry = Math.floor(Math.random() * countries.length);
            randItem.country_of_origin = countries[randomCountry];

            randItem.sku = this.makeId(5);
            randItem.hs_code = this.makeId(10);
            this.formItem = {...randItem};
        }
    }
}
</script>

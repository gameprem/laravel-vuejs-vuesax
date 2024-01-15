<template>
  <section>
    <Head title="แดชบอร์ด" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">แดชบอร์ด</h2>
      </template>

      <div class="py-12">
        <form @submit.prevent="form.post(route('dashboard.create'))" class="mt-6 space-y-6">
          <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
              <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
              <div class="p-6">
                <label class="form-control w-full">
                  <div class="label">
                    <span class="label-text">หมายเลขสมาชิก *</span>
                  </div>
                  <input
                    type="text"
                    v-model="form.membership_number"
                    placeholder="หมายเลขสมาชิก"
                    class="block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none"
                  />
                </label>
                <label class="form-control w-full">
                  <div class="label">
                    <span class="label-text">ชื่อลูกค้า</span>
                  </div>
                  <input
                    type="text"
                    v-model="form.customer_name"
                    placeholder="ป้อนชื่อ"
                    class="block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none max-w-xs"
                  />
                </label>
                <label class="form-control w-full">
                  <div class="label">
                    <span class="label-text">เบอร์โทร</span>
                  </div>
                  <input
                    type="text"
                    v-model="form.phone_number"
                    placeholder="ป้อนเบอร์โทร"
                    class="block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none max-w-xs"
                  />
                </label>
                <div class="py-5 overflow-x-auto">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>จำนวน</th>
                        <th>สินค้า</th>
                        <th>แถม</th>
                        <th>ราคา</th>
                        <th>ยอดเงิน</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>1</th>
                        <td>0</td>
                        <td>ซาโกร 11-6-25 (50kg.) (50 กิโลกรัม)</td>
                        <td>-</td>
                        <td>1,720</td>
                        <td>0 บาท</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>

                        <th>รวมทั้งสิ้น</th>
                        <th>0 บาท</th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <Multiselect
                  mode="tags"
                  placeholder="Choose ..."
                  track-by="name"
                  label="name"
                  :close-on-select="false"
                  :searchable="true"
                  :options="options"
                >
                  <template
                    v-slot:tag="{
                            option,
                            handleTagRemove,
                            disabled,
                        }"
                  >
                    <div
                      class="multiselect-tag is-user"
                      :class="{
                                'is-disabled': disabled,
                            }"
                    >
                      {{ option.name }}
                      <span
                        v-if="!disabled"
                        class="multiselect-tag-remove"
                        @click="handleTagRemove(option, $event)"
                      >
                        <span class="multiselect-tag-remove-icon"></span>
                      </span>
                    </div>
                  </template>
                </Multiselect>
              </div>
            </div>
          </div>
          <div class="py-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
              <button :disabled="form.processing" class="btn btn-primary text-white">บันทึก</button>

              <div class="space-x-2 sm:-my-px sm:ms-10 sm:flex">
                <Link :href="route('manage-products')">
                  <button class="btn btn-primary text-white">จัดการสินค้า</button>
                </Link>
                <Link :href="route('summary-of-sales')">
                  <button class="btn btn-warning text-white">สรุปยอดขาย</button>
                </Link>
                <Link :href="route('bill-history')">
                  <button class="btn btn-success text-white">ประวัติบิล</button>
                </Link>
              </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
              <div class="py-5 overflow-x-auto">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>จำนวน</th>
                      <th>ขนาด</th>
                      <th>สินค้า</th>
                      <th>ราคา</th>
                      <th>ของแถม</th>
                      <th>ยกลัง</th>
                      <th>ยอดเงิน</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in products" :key="index">
                      <th>1</th>
                      <td>0</td>
                      <td>50 กิโลกรัม</td>
                      <td>{{item.name}}</td>
                      <td>1,720</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="mt-5 flex justify-between h-16">
              <button :disabled="form.processing" class="btn btn-primary text-white">บันทึก</button>
            </div>
          </div>
        </form>
      </div>
    </AuthenticatedLayout>
  </section>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Multiselect from "@vueform/multiselect";

import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  membership_number: "",
  customer_name: "",
  phone_number: "",
  products: [],
  free_gift: []
});
</script>
<script>
export default {
  data() {
    return {
      value: null,
      options: [
        {
          value: "judy",
          name: "Judy"
        },
        {
          value: "jane",
          name: "Jane"
        },
        {
          value: "john",
          name: "John"
        },
        {
          value: "joe",
          name: "Joe"
        }
      ],
      products: []
    };
  },
  mounted() {
    fetch("api/products")
      .then(response => response.json())
      .then(data => {
        this.products = data;
      });
  },
  methods: {
    search() {
      console.log("Searching for:", this.searchTerm);
    },
    updateSuggestions() {
      this.filteredSuggestions = this.suggestions.filter(suggestion =>
        suggestion.toLowerCase().includes(this.searchTerm.toLowerCase())
      );
    },
    selectSuggestion(suggestion) {
      this.searchTerm = suggestion;
      this.filteredSuggestions = [];
    }
  }
};
</script>
<style>
@import "@vueform/multiselect/themes/tailwind.css";
/* or */
/* @import './path/to/node_modules/@vueform/multiselect/themes/tailwind.css'; */
</style>

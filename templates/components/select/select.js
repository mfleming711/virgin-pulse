import isEqual from 'lodash.isequal';

window.selectComponent = config => {
  return {
    isMulti: !!config?.isMulti,
    value: config?.value || !!config?.isMulti ? [] : '',
    options: [],
    open: false,

    init() {
      this.options = [...this.$refs.select.options].map(o => {
        return { value: o.value, label: o.innerText };
      });

      const selectedOptions = [
        ...this.$el.querySelectorAll('option[selected]'),
      ];

      this.value = this.isMulti
        ? selectedOptions.map(o => o.value)
        : selectedOptions[0]?.value || '';

      this.$watch('value', (next, prev) => {
        // prevent update loop
        if (isEqual(prev, next)) return;
        // manually fire change event so parents can listen to state changes
        this.$el.querySelector('select')?.dispatchEvent(new Event('change'));
      });
    },

    get currentLabel() {
      if (this.isMulti) {
        if (!this.value?.length) return config.placeholder;
        return config.placeholder + '&nbsp;(' + this.value.length + ')';
      }
      return this.options.find(({ value }) => value === this.value)?.label;
    },

    get hasValue() {
      return this.isMulti ? !!this.value?.length : !!this.value;
    },

    isSelected(value) {
      if (this.isMulti) {
        return this.value.includes(value);
      }
      return value === this.value;
    },

    setValue(value) {
      if (this.isMulti) {
        this.value.includes(value)
          ? (this.value = this.value.filter(v => v !== value))
          : (this.value = [...this.value, value]);
      } else {
        this.value === value ? (this.value = '') : (this.value = value);
      }
    },

    toggleSelect() {
      this.open = !this.open;
    },
  };
};

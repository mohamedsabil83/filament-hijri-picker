import hijriDateTimePickerFormComponent from './components/hijri-date-time-picker';

document.addEventListener('alpine:init', () => {
    Alpine.plugin(hijriDateTimePickerFormComponent);
});
// export default (Alpine) => {
//     Alpine.plugin(hijriDateTimePickerFormComponent);
// };

// export { hijriDateTimePickerFormComponent };

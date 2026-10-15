@php
    use Filament\Support\Facades\FilamentView;

    $datalistOptions = $getDatalistOptions();
    $extraAlpineAttributes = $getExtraAlpineAttributes();
    $id = $getId();
    $isDisabled = $isDisabled();
    $isPrefixInline = $isPrefixInline();
    $isSuffixInline = $isSuffixInline();
    $prefixActions = $getPrefixActions();
    $prefixIcon = $getPrefixIcon();
    $prefixLabel = $getPrefixLabel();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixLabel = $getSuffixLabel();
    $statePath = $getStatePath();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    :inline-label-vertical-alignment="\Filament\Support\Enums\VerticalAlignment::Center"
>
    <x-filament::input.wrapper
        :disabled="$isDisabled"
        :inline-prefix="$isPrefixInline"
        :inline-suffix="$isSuffixInline"
        :prefix="$prefixLabel"
        :prefix-actions="$prefixActions"
        :prefix-icon="$prefixIcon"
        :prefix-icon-color="$getPrefixIconColor()"
        :suffix="$suffixLabel"
        :suffix-actions="$suffixActions"
        :suffix-icon="$suffixIcon"
        :suffix-icon-color="$getSuffixIconColor()"
        :valid="! $errors->has($statePath)"
        :attributes="\Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())"
    >
        {{--
            Styling note: Filament 4/5 ship a precompiled stylesheet, so Tailwind utility
            classes written in package views are never generated. Use Filament's own
            `fi-fo-date-time-picker-*` component classes instead (they live in Filament's CSS).
        --}}
        <div
            @if (FilamentView::hasSpaMode())
                x-load="visible"
            @else
                x-load
            @endif
            x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-hijri-picker', 'mohamedsabil83/filament-hijri-picker') }}"
            x-data="hijriDateTimePickerFormComponent({
                displayFormat: '{{ convert_date_format($getDisplayFormat())->to('day.js') }}',
                firstDayOfWeek: {{ $getFirstDayOfWeek() }},
                isAutofocused: @js($isAutofocused()),
                locale: @js(app()->getLocale()),
                shouldCloseOnDateSelection: @js($shouldCloseOnDateSelection()),
                state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')") }},
            })"
            x-on:keydown.esc="isOpen() && $event.stopPropagation()"
            {{
                $attributes
                    ->merge($getExtraAttributes(), escape: false)
                    ->merge($getExtraAlpineAttributes(), escape: false)
                    ->class(['fi-fo-date-time-picker', 'filament-hijri-picker'])
            }}
        >
            <input
                x-ref="maxDate"
                type="hidden"
                value="{{ $getMaxDate() }}"
            />

            <input
                x-ref="minDate"
                type="hidden"
                value="{{ $getMinDate() }}"
            />

            <input
                x-ref="disabledDates"
                type="hidden"
                value="{{ json_encode($getDisabledDates()) }}"
            />

            <button
                x-ref="button"
                x-on:click="togglePanelVisibility()"
                x-on:keydown.enter.stop.prevent="
                    if (! $el.disabled) {
                        isOpen() ? selectDate() : togglePanelVisibility()
                    }
                "
                x-on:keydown.arrow-left.stop.prevent="if (! $el.disabled) focusPreviousDay()"
                x-on:keydown.arrow-right.stop.prevent="if (! $el.disabled) focusNextDay()"
                x-on:keydown.arrow-up.stop.prevent="if (! $el.disabled) focusPreviousWeek()"
                x-on:keydown.arrow-down.stop.prevent="if (! $el.disabled) focusNextWeek()"
                x-on:keydown.backspace.stop.prevent="if (! $el.disabled) clearState()"
                x-on:keydown.clear.stop.prevent="if (! $el.disabled) clearState()"
                x-on:keydown.delete.stop.prevent="if (! $el.disabled) clearState()"
                aria-label="{{ $getPlaceholder() }}"
                type="button"
                tabindex="-1"
                @disabled($isDisabled)
                {{
                    $getExtraTriggerAttributeBag()->class([
                        'fi-fo-date-time-picker-trigger',
                    ])
                }}
            >
                <input
                    @disabled($isDisabled)
                    readonly
                    placeholder="{{ $getPlaceholder() }}"
                    wire:key="{{ $this->getId() }}.{{ $statePath }}.{{ $field::class }}.display-text"
                    x-model="displayText"
                    @if ($id = $getId()) id="{{ $id }}" @endif
                    class="fi-fo-date-time-picker-display-text-input"
                />
            </button>

            <div
                x-ref="panel"
                x-cloak
                x-float.placement.bottom-start.offset.flip.shift="{ offset: 8 }"
                wire:ignore
                wire:key="{{ $this->getId() }}.{{ $statePath }}.{{ $field::class }}.panel"
                class="fi-fo-date-time-picker-panel filament-hijri-picker-panel"
            >
                @if ($hasDate())
                    <div class="fi-fo-date-time-picker-panel-header">
                        <select
                            x-model="focusedMonth"
                            class="fi-fo-date-time-picker-month-select"
                        >
                            <template
                                x-for="(month, index) in months"
                            >
                                <option
                                    x-bind:value="index"
                                    x-text="month"
                                ></option>
                            </template>
                        </select>

                        <input
                            type="number"
                            inputmode="numeric"
                            x-model.debounce="focusedYear"
                            class="fi-fo-date-time-picker-year-input"
                        />
                    </div>

                    <div class="fi-fo-date-time-picker-calendar-header">
                        <template
                            x-for="(day, index) in dayLabels"
                            x-bind:key="index"
                        >
                            <div
                                x-text="day"
                                class="fi-fo-date-time-picker-calendar-header-day"
                            ></div>
                        </template>
                    </div>

                    <div role="grid" class="fi-fo-date-time-picker-calendar">
                        <template
                            x-for="day in emptyDaysInFocusedMonth"
                            x-bind:key="day"
                        >
                            <div></div>
                        </template>

                        <template
                            x-for="day in daysInFocusedMonth"
                            x-bind:key="day"
                        >
                            <div
                                x-text="day"
                                x-on:click="dayIsDisabled(day) || selectDate(day)"
                                x-on:mousedown.prevent
                                x-on:mouseenter="setFocusedDay(day)"
                                role="option"
                                x-bind:aria-selected="focusedDate.date() === day"
                                x-bind:class="{
                                    'fi-fo-date-time-picker-calendar-day-today': dayIsToday(day),
                                    'fi-focused': focusedDate.date() === day,
                                    'fi-selected': dayIsSelected(day),
                                    'fi-disabled': dayIsDisabled(day),
                                }"
                                class="fi-fo-date-time-picker-calendar-day"
                            ></div>
                        </template>
                    </div>
                @endif

                @if ($hasTime())
                    <div class="fi-fo-date-time-picker-time-inputs">
                        <input
                            max="23"
                            min="0"
                            step="{{ $getHoursStep() }}"
                            type="number"
                            inputmode="numeric"
                            x-model.debounce="hour"
                        />

                        <span class="fi-fo-date-time-picker-time-input-separator">:</span>

                        <input
                            max="59"
                            min="0"
                            step="{{ $getMinutesStep() }}"
                            type="number"
                            inputmode="numeric"
                            x-model.debounce="minute"
                        />

                        @if ($hasSeconds())
                            <span class="fi-fo-date-time-picker-time-input-separator">:</span>

                            <input
                                max="59"
                                min="0"
                                step="{{ $getSecondsStep() }}"
                                type="number"
                                inputmode="numeric"
                                x-model.debounce="second"
                            />
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </x-filament::input.wrapper>

    @if ($datalistOptions)
        <datalist id="{{ $id }}-list">
            @foreach ($datalistOptions as $option)
                <option value="{{ $option }}" />
            @endforeach
        </datalist>
    @endif
</x-dynamic-component>

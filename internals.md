# [Changes to PHP Internals in PHP 5.5](index.md)

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.internals.php)

## Changes to PHP Internals

- Extensions cannot override **zend_execute()** any more and should override **zend_execute_ex()** instead. `EG(current_execute_data)` is already initialized in **zend_execute_ex()**, so for compatibility extensions may need to use `EG(current_execute_data)->prev_execute_data` instead.
- Removed `EG(arg_types_stack)`, `EX(fbc)`, `EX(called_scope)` and `EX(current_object)`.
- Added `op_array->nested_calls`, which is calculated at compile time.
- Added `EX(call_slots)`, which is an array to store information about syntaticaly nested calls (e.g. `foo(bar())`) and is preallocated together with `execute_data`.
- Added `EX(call)`, which is a pointer to a current calling function, and is an element of `EX(call_slots)`.
- Opcodes [INIT_METHOD_CALL](https://php-legacy-docs.zend.com/manual/php5/en/internals2.opcodes.init-method-call.html), [ZEND_INIT_STATIC_METHOD_CALL](https://php-legacy-docs.zend.com/manual/php5/en/internals2.opcodes.init-static-method-call.html), [ZEND_INIT_FCALL_BY_NAME](https://php-legacy-docs.zend.com/manual/php5/en/internals2.opcodes.init-fcall-by-name.html) and [ZEND_INIT_NS_FCALL_BY_NAME](https://php-legacy-docs.zend.com/manual/php5/en/internals2.opcodes.init-ns-fcall-by-name.html) use `result.num` as an index in `EX(call_slots)`.
- Opcode [ZEND_NEW](https://php-legacy-docs.zend.com/manual/php5/en/internals2.opcodes.new.html) uses `extended_value` as an index in `EX(call_slots)`.
- Opcodes [ZEND_DO_FCALL](https://php-legacy-docs.zend.com/manual/php5/en/internals2.opcodes.do-fcall.html) and [ZEND_DO_FCALL_BY_NAME](https://php-legacy-docs.zend.com/manual/php5/en/internals2.opcodes.do-fcall-by-name.html) use `op2.num` as an index in `EX(call_slots)`.
- Added `op_array->used_stack`, which is calculated at compile time; the corresponding stack space is preallocated together with `execute_data`. As a result, the ZEND_SEND\* and ZEND_DO_FCALL\* opcodes no longer need to check for stack overflow.
- Removed `execute_data->Ts` field. The VM temporary variables are always allocated immediately before the `execute_data` structure, and are now accessed by their offset from the `execute_data` base pointer instead of via `execute_data->Ts`. The compiler stores new offsets in `op_array->opcodes[*].op?.num`. The **EX_TMP_VAR()** and **EX_TMP_VAR_NUM()** macros can be used to access temporary variables by offset or number. You can convert the number to an offset using **EX_TMP_VAR_NUM(0, num)** or offset to number using **(EX_TMP_VAR_NUM(0,0)-EX_TMP_VAR(0,offset))**.
- Removed the `execute_data->CVs` field. The VM compiled variables are always allocated immediately after the `execute_data` structure, and are now accessed by the offset from the `execute_data` base pointer instead of via `execute_data->CVs`. You can use the **EX_CV_NUM()** macro to access compiled variables by number.

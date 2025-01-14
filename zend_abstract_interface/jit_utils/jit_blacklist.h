#ifndef ZAI_JIT_BLACKLIST_H
#define ZAI_JIT_BLACKLIST_H

#include <main/php_version.h>
#include <Zend/zend_compile.h>

#ifdef __x86_64__
#define ZAI_JIT_BLACKLIST_ACTIVE PHP_VERSION_ID >= 80000
#elif defined(__aarch64__)
#define ZAI_JIT_BLACKLIST_ACTIVE PHP_VERSION_ID >= 80100
#else
#define ZAI_JIT_BLACKLIST_ACTIVE 0
#endif

#if ZAI_JIT_BLACKLIST_ACTIVE
void zai_jit_minit(void);
void zai_jit_blacklist_function_inlining(zend_op_array *op_array);
#endif

#endif // ZAI_JIT_BLACKLIST_H

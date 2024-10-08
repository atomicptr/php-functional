# Atomicptr\Functional\Option  

Represents an optional value: every Option is either Some and contains a value, or None, and does not.

This type is used in cases where a value may or may not be present.  





## Methods

| Name | Description |
|------|-------------|
|[bind](#optionbind)|Applies a function to the contained value (if any) and returns the result.|
|[collection](#optioncollection)|Returns a collection of T when it has a value, otherwise returns an empty collection.|
|[isNone](#optionisnone)|Checks if this Option is a None variant.|
|[isSome](#optionissome)|Checks if this Option is a Some variant.|
|[none](#optionnone)|Creates a None variant of Option, representing the absence of a value.|
|[orElse](#optionorelse)|Returns value of object if present, otherwise returns $value (executes it if its callable)|
|[some](#optionsome)|Creates a Some variant of Option containing the given value.|
|[value](#optionvalue)|Returns the contained value if this Option is Some.|




### Option::bind  

**Description**

```php
public bind (callable $fn)
```

Applies a function to the contained value (if any) and returns the result. 

If this Option is None, returns None without calling the function. 

**Parameters**

* `(callable) $fn`
: The function to apply to the contained value.  

**Return Values**

`\Option<\U>`

> The result of applying the function, or None if this Option is None.


<hr />


### Option::collection  

**Description**

```php
public collection (void)
```

Returns a collection of T when it has a value, otherwise returns an empty collection. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<\T>`




<hr />


### Option::isNone  

**Description**

```php
public isNone (void)
```

Checks if this Option is a None variant. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`bool`

> True if this Option is None, false otherwise.


<hr />


### Option::isSome  

**Description**

```php
public isSome (void)
```

Checks if this Option is a Some variant. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`bool`

> True if this Option is Some, false otherwise.


<hr />


### Option::none  

**Description**

```php
public static none (void)
```

Creates a None variant of Option, representing the absence of a value. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Option<\T>`

> An Option representing no value.


<hr />


### Option::orElse  

**Description**

```php
public orElse (void)
```

Returns value of object if present, otherwise returns $value (executes it if its callable) 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T|\U`




<hr />


### Option::some  

**Description**

```php
public static some (\T $value)
```

Creates a Some variant of Option containing the given value. 

 

**Parameters**

* `(\T) $value`
: The value to wrap in Some.  

**Return Values**

`\Option<\T>`

> An Option containing the value.


<hr />


### Option::value  

**Description**

```php
public value (void)
```

Returns the contained value if this Option is Some. 

Throws an assertion error if this Option is None. 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`

> The contained value.


**Throws Exceptions**


`\AssertionError`
> If this Option is None.

<hr />


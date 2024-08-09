# Atomicptr\Functional\Lst  

A collection of functions for operating on "lists" (PHP arrays)





## Methods

| Name | Description |
|------|-------------|
|[append](#lstappend)|Concatenates two lists.|
|[every](#lstevery)|Returns true if all elements in the list satisfy the predicate $fn.|
|[filter](#lstfilter)|Applies the function $fn to every element of $list and builds a new list with the elements of $list where $fn returned true|
|[find](#lstfind)|Iterates over $list until one element applied to $fn returns true and return that element.|
|[flatten](#lstflatten)|Flattens a nested array structure.|
|[foldl](#lstfoldl)|Reduces the array to a single value by applying $fn from left to right.|
|[foldr](#lstfoldr)|Reduces the array to a single value by applying $fn from right to left.|
|[forAll](#lstforall)|Applies the function $fn to every element of $list.|
|[hd](#lsthd)|Returns the first element of the list.|
|[init](#lstinit)|Creates a new list of given length using the provided function.|
|[length](#lstlength)|Returns the number of elements in the list.|
|[map](#lstmap)|Applies the function $fn to every element of $list and builds a new list with the results returned by $fn.|
|[rev](#lstrev)|Returns a new list with elements in reverse order.|
|[some](#lstsome)|Returns true if at least one element in the list satisfies the predicate $fn.|
|[tl](#lsttl)|Returns a new list containing all elements except the first.|




### Lst::append  

**Description**

```php
public static append (\T[] $lst1, \U[] $lst2)
```

Concatenates two lists. 

 

**Parameters**

* `(\T[]) $lst1`
* `(\U[]) $lst2`

**Return Values**

`(\T|\U)[]`




<hr />


### Lst::every  

**Description**

```php
public static every (callable $fn)
```

Returns true if all elements in the list satisfy the predicate $fn. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`bool`




<hr />


### Lst::filter  

**Description**

```php
public static filter (callable $fn)
```

Applies the function $fn to every element of $list and builds a new list with the elements of $list where $fn returned true 

Same as array_filter 

**Parameters**

* `(callable) $fn`

**Return Values**

`void`


<hr />


### Lst::find  

**Description**

```php
public static find (callable $fn)
```

Iterates over $list until one element applied to $fn returns true and return that element. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Option<\T>`




<hr />


### Lst::flatten  

**Description**

```php
public static flatten ((\T|\T[])[] $lst)
```

Flattens a nested array structure. 

 

**Parameters**

* `((\T|\T[])[]) $lst`

**Return Values**

`\T[]`




<hr />


### Lst::foldl  

**Description**

```php
public static foldl (callable $fn, \R $initial)
```

Reduces the array to a single value by applying $fn from left to right. 

 

**Parameters**

* `(callable) $fn`
* `(\R) $initial`

**Return Values**

`\R`




<hr />


### Lst::foldr  

**Description**

```php
public static foldr (callable $fn, \R $initial)
```

Reduces the array to a single value by applying $fn from right to left. 

 

**Parameters**

* `(callable) $fn`
* `(\R) $initial`

**Return Values**

`\R`




<hr />


### Lst::forAll  

**Description**

```php
public static forAll (callable $fn)
```

Applies the function $fn to every element of $list. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`void`




<hr />


### Lst::hd  

**Description**

```php
public static hd (\T[] $lst)
```

Returns the first element of the list. 

 

**Parameters**

* `(\T[]) $lst`

**Return Values**

`\T`




<hr />


### Lst::init  

**Description**

```php
public static init (callable $fn, int $length)
```

Creates a new list of given length using the provided function. 

 

**Parameters**

* `(callable) $fn`
* `(int) $length`

**Return Values**

`\T[]`




<hr />


### Lst::length  

**Description**

```php
public static length (\T[] $lst)
```

Returns the number of elements in the list. 

 

**Parameters**

* `(\T[]) $lst`

**Return Values**

`int`




<hr />


### Lst::map  

**Description**

```php
public static map (callable $fn)
```

Applies the function $fn to every element of $list and builds a new list with the results returned by $fn. 

Same as array_map 

**Parameters**

* `(callable) $fn`

**Return Values**

`void`


<hr />


### Lst::rev  

**Description**

```php
public static rev (\T[] $lst)
```

Returns a new list with elements in reverse order. 

 

**Parameters**

* `(\T[]) $lst`

**Return Values**

`\T[]`




<hr />


### Lst::some  

**Description**

```php
public static some (callable $fn)
```

Returns true if at least one element in the list satisfies the predicate $fn. 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`bool`




<hr />


### Lst::tl  

**Description**

```php
public static tl (\T[] $lst)
```

Returns a new list containing all elements except the first. 

 

**Parameters**

* `(\T[]) $lst`

**Return Values**

`\T[]`




<hr />


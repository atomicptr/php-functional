# Atomicptr\Functional\Collection  

A wrapper around PHP arrays enabling piping several functions together





## Methods

| Name | Description |
|------|-------------|
|[append](#collectionappend)|Append another collection to this collection|
|[every](#collectionevery)|Check if all elements in the collection satisfy the predicate function|
|[filter](#collectionfilter)|Filter the collection based on a predicate function|
|[find](#collectionfind)|Find the first element that satisfies a predicate function|
|[flatten](#collectionflatten)|Flatten a nested collection structure|
|[foldl](#collectionfoldl)|Reduce the collection to a single value, applying the function from left to right|
|[foldr](#collectionfoldr)|Reduce the collection to a single value, applying the function from right to left|
|[forAll](#collectionforall)|Apply a function to each element in the collection without returning a value|
|[from](#collectionfrom)|Create a new collection from an already existing list|
|[fromIterator](#collectionfromiterator)|Create a new collection from an iterator (This will load the entire iterator into memory)|
|[get](#collectionget)|Get the element at the given index, wrapped in an Option|
|[has](#collectionhas)|Check if the collection has an element at the given index|
|[hd](#collectionhd)|Get the first element of the collection|
|[length](#collectionlength)|Get the number of elements in the collection|
|[map](#collectionmap)|Apply a function to each element in the collection|
|[rev](#collectionrev)|Reverse the order of elements in the collection|
|[some](#collectionsome)|Check if any element in the collection satisfies the predicate function|
|[tl](#collectiontl)|Get a new collection with all elements except the first|
|[toArray](#collectiontoarray)|Convert the collection to a PHP array|




### Collection::append  

**Description**

```php
public append (\Collection<\T> $collection)
```

Append another collection to this collection 

 

**Parameters**

* `(\Collection<\T>) $collection`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::every  

**Description**

```php
public every (callable $fn)
```

Check if all elements in the collection satisfy the predicate function 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`bool`




<hr />


### Collection::filter  

**Description**

```php
public filter (callable $fn)
```

Filter the collection based on a predicate function 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::find  

**Description**

```php
public find (callable $fn)
```

Find the first element that satisfies a predicate function 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Option<\T>`




<hr />


### Collection::flatten  

**Description**

```php
public flatten (void)
```

Flatten a nested collection structure 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::foldl  

**Description**

```php
public foldl (callable $fn, \U $initial)
```

Reduce the collection to a single value, applying the function from left to right 

 

**Parameters**

* `(callable) $fn`
* `(\U) $initial`

**Return Values**

`\U`




<hr />


### Collection::foldr  

**Description**

```php
public foldr (callable $fn, \U $initial)
```

Reduce the collection to a single value, applying the function from right to left 

 

**Parameters**

* `(callable) $fn`
* `(\U) $initial`

**Return Values**

`\U`




<hr />


### Collection::forAll  

**Description**

```php
public forAll (callable $fn)
```

Apply a function to each element in the collection without returning a value 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`void`




<hr />


### Collection::from  

**Description**

```php
public static from (\T[] $array)
```

Create a new collection from an already existing list 

 

**Parameters**

* `(\T[]) $array`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::fromIterator  

**Description**

```php
public static fromIterator (\Iterator<\T> $iterator)
```

Create a new collection from an iterator (This will load the entire iterator into memory) 

 

**Parameters**

* `(\Iterator<\T>) $iterator`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::get  

**Description**

```php
public get (int $index)
```

Get the element at the given index, wrapped in an Option 

 

**Parameters**

* `(int) $index`

**Return Values**

`\Option<\T>`




<hr />


### Collection::has  

**Description**

```php
public has (mixed $index)
```

Check if the collection has an element at the given index 

 

**Parameters**

* `(mixed) $index`

**Return Values**

`bool`




<hr />


### Collection::hd  

**Description**

```php
public hd (void)
```

Get the first element of the collection 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T`




<hr />


### Collection::length  

**Description**

```php
public length (void)
```

Get the number of elements in the collection 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`int`




<hr />


### Collection::map  

**Description**

```php
public map (callable $fn)
```

Apply a function to each element in the collection 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`\Collection<\U>`




<hr />


### Collection::rev  

**Description**

```php
public rev (void)
```

Reverse the order of elements in the collection 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::some  

**Description**

```php
public some (callable $fn)
```

Check if any element in the collection satisfies the predicate function 

 

**Parameters**

* `(callable) $fn`

**Return Values**

`bool`




<hr />


### Collection::tl  

**Description**

```php
public tl (void)
```

Get a new collection with all elements except the first 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Collection<\T>`




<hr />


### Collection::toArray  

**Description**

```php
public toArray (void)
```

Convert the collection to a PHP array 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\T[]`




<hr />

